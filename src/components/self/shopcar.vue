<template>
  <div class="shopcarDiv">
    <otherheader></otherheader>
      <el-row v-if='!shopcarPdtRcdNum'>
        <p>暂无商品,<span @click="goToGoodsList()" id="wannatobuy">去购物</span></p>
      </el-row>
      <el-row v-if='shopcarPdtRcdNum'>
        <el-row id='checkAllER'>
          <el-checkbox v-model="checkedAll">全选中</el-checkbox>
          <el-checkbox v-model="cancelAll">反选</el-checkbox>
        </el-row>
        <el-row>
          <ul>
           <li v-for='(item,index) in shopcarPdtRcd'>
             <el-checkbox v-model='item.pflag' :value="item.pflag" class='itemChb' @change='chbChange(item)'></el-checkbox>
             <span class='itemName textOverWithElls'>{{item.pname}}</span>
             <img :src="item.pic" alt="" width='100px'  class="itemImg">
             <span  class="itemPrice">￥{{item.price}}</span>
             <span class="itemSalCount">
               <i @click='del(item,index)'>-</i>
               <input type="text"  v-model='item.salecount' @keydown='recordSalecount(item)' @keyup="handleSalecount(item)" @blur="correct(item)">
               <i @click='add(item,index)'>+</i></span>
             <span class="itemTtlCount">{{item.totalcount}}</span>
             <span class='itemTtlPrice hidden-xs' v-model='xiaojiArr'>{{item.salecount*100*item.price/100}}</span>
           </li>
          </ul>
          <p id='totalPriceP'>总计:{{totalPrice}}</p>
          <el-row class="jiezhang">
            <el-button type="success" size='big' class="right-float" id="xiadanBtn" @click="orders()">下单</el-button>
          </el-row>
        </el-row>
      </el-row>
  </div>
</template>

<script>
import otherheader from '@/components/comman/otherheader';
export default {
  name: 'hello',
  components:{
    otherheader
  },
  data () {
    return {
      lastSalecount:0,
      xiaojiArr:[],
      totalPrice:123,
      tabledata:[],
      shopcarPdtRcdNum:0,
      checkedAll:false,
      cancelAll:false,
      shopcarPdtRcd:[],
      // shopcarPdtRcd:
      // [
      //   {id:1,pflag:true,pid:13,pname:'电视机13号',pic:'/static/dianshiji1.jpg',price:23997.00,salecount:1,totalcount:10},
      //   {id:2,pflag:false,pid:14,pname:'电视机14号',pic:'/static/dianshiji2.jpg',price:23997.00,salecount:1,totalcount:10}
      // ],
      checkArr:[]
    }
  },
  created:function(){
    let xhr = new XMLHttpRequest();
    let self = this;
    let userid=window.sessionStorage.getItem("userid");
    xhr.open("get","http://localhost/palmstore/data/getShopRecord.php?userid="+userid,true);
    xhr.onreadystatechange=function(){
      if(xhr.readyState==4&&xhr.status==200){
        let response = JSON.parse(xhr.responseText);
        if(response.code==undefined){
          self.shopcarPdtRcdNum=response.length;
          if(response.length>0){
            for(let i=0;i<response.length;i++){
              self.shopcarPdtRcd.push(response[i]);
            }
          }
          self.isAllChecked();
          self.computedTtlPrice();
        }else{
          self.shopcarPdtRcdNum=0;
        }
      }
    };
    xhr.send();
  },
  watch:{
    'checkedAll':function(val,oldVal){
      if (val) {
        this.shopcarPdtRcd.forEach(item=>{
          item.pflag=val;
        })
        this.cancelAll=false;
        this.computedTtlPrice();
      }
    },
    'cancelAll':function(val,oldVal){
      if (val) {
        this.shopcarPdtRcd.forEach(item=>{
          item.pflag=!item.pflag;
        })
        this.isAllChecked();
        this.computedTtlPrice();
      }
    }
  },
  methods:{
    updateShopRecord(item){
      let xhr = new XMLHttpRequest();
      xhr.open("post","http://localhost/palmstore/data/updateShopRecord.php",true);
      xhr.onreadystatechange=function(){
        if(xhr.readyState==4&&xhr.status==200){
          let response=JSON.parse(xhr.response);
          if(response.code==-1){
            //alert(response.msg);
          }else{
            //alert(response.msg);
          }
        }
      }
      xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
      xhr.send("scid="+item.id+"&pflag="+item.pflag+"&salecount="+item.salecount);
    },
    add(item,index){
      if(item.salecount<item.totalcount){
        item.salecount=parseInt(item.salecount)+1;
        item.pflag=true;
      }
      this.isAllChecked();
      this.computedTtlPrice();
      this.updateShopRecord(item);
    },
    del(item,index){
      if(item.salecount>0){
        item.salecount-=1;
        item.salecount==0? item.pflag=false:item.pflag=true ;
      }
      this.isAllChecked();
      this.computedTtlPrice();
      this.updateShopRecord(item);
    },
    chbChange(item){
      if(item.pflag&&item.salecount==0){
        item.salecount=1;
      }
      this.isAllChecked();
      this.computedTtlPrice();
      this.updateShopRecord(item);
    },
    computedTtlPrice(){
      let ttlPrice=0;
      this.shopcarPdtRcd.forEach(item=>{
          if(item.pflag){
            ttlPrice+=item.price*100*item.salecount;
          };
      })
      return this.totalPrice=ttlPrice/100;
    },
    isAllChecked(){
      for(let i=0;i<this.shopcarPdtRcd.length;i++){
        if(!this.shopcarPdtRcd[i].pflag){
          return this.checkedAll=false;
        }
      }
      this.checkedAll=true;
    },
    goToGoodsList(){
      this.$router.push({path:'/'});
    },
    handleSalecount(item){
      if(isNaN(item.salecount)||((item.salecount!=0)&&!parseInt(item.salecount))||parseInt(item.salecount)<0){
        item.salecount=this.lastSalecount;
        return ;
      }
      if(item.salecount>item.totalcount){
        item.salecount=item.totalcount;
      }
      if(item.salecount>0){
        item.pflag=true;
      }else{
        item.pflag=false;
      }
      this.isAllChecked();
      this.computedTtlPrice();
      this.updateShopRecord(item);
    },
    correct(item){
      if(Number(item.salecount)==0){
        item.salecount=0;
      }
    }
    ,
    recordSalecount(item){
      this.lastSalecount=item.salecount;
    },
    orders(){
      let flag=false;
      for(let item of this.shopcarPdtRcd){
        if(item.salecount==""){
          item.salecount=0;
          item.pflag=false;
        }
        if(item.pflag){
          flag=item.pflag;
        }
      }
      if(flag){
        let self=this;
        let xhr = new XMLHttpRequest();
        xhr.open("post","http://localhost/palmstore/data/addorderrecord.php",true);
        xhr.onreadystatechange=function(){
          if(xhr.readyState==4&&xhr.status==200){
            let response = JSON.parse(xhr.responseText);
            if(response.code==1){
              for(let item in self.shopcarPdtRcd){
                if(self.shopcarPdtRcd[item].pflag){
                  self.shopcarPdtRcd.splice(item,1);
                }
              }
              self.totalPrice=0;
              self.shopcarPdtRcdNum=self.shopcarPdtRcd.length;
            }
            alert(response.msg);
          }
        }
        xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        xhr.send("userid="+window.sessionStorage.getItem("userid"));
      }else{
        alert("没选中商品，无法下单");
      }
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
*{
  font-size:10px;
  box-sizing: border-box;
}
li i{
  display: inline-block;
  width:20%;
  height:20px;
  text-align: center;
  line-height: 20px;
  font-size:20px;
}
li input{
  width:50%;
  text-align:center;
}
#checkAllER{
  padding:10px 0 10px 20px;
  border-bottom:1px solid #dddddd;
}
.shopcarDiv{
  margin-top: 40px;
}
#totalPriceP{
  padding-right:10px;
  text-align:right;
  font-size:18px;
}
#xiadanBtn{
  margin-right:10px;
}
.itemName,.itemImg,.itemPrice,.itemSalCount,.itemTtlCount,.itemTtlPrice{
  display: inline-block;
  position: relative;
}
@media (max-width:767px){
  .itemName{
    width:20%;
  }
  .itemImg{
    width:25%;
  }
  .itemPrice{
    width:12%;
  }
  .itemSalCount{
    width:25%;
  }
  .itemTtlCount{
    width:8%;
  } 
  .itemTtlPrice{
    width:0%;
  }
  .itemChb,.itemName,.itemPrice,.itemSalCount,.itemTtlCount,.itemTtlPrice{
    bottom:40px;
  }
}
@media (min-width:768px){
  *{
    font-size:16px;
  }
  .itemName{
    width:25%;
  }
  .itemImg{
    width:25%;
  }
  .itemPrice{
    width:12%;
  }
  .itemSalCount{
    width:15%;
  }
  .itemTtlCount{
    width:7%;
  }
  .itemTtlPrice{
    width:10%;
  }
  .itemChb,.itemName,.itemPrice,.itemSalCount,.itemTtlCount,.itemTtlPrice{
    bottom:90px;
  }
  #wannatobuy{
    color:red;
  }
}
</style>

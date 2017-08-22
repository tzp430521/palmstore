<template>
  <div class="detailDiv">
    <otherheader></otherheader>
    <el-row class="hidden-sm" v-if='!isPad'>
      <el-carousel>
        <el-carousel-item v-for="(item,index) in productImgs" :key="index" >
            <img :src="item" class="img-response" alt="">
        </el-carousel-item>
      </el-carousel>
      <el-row>
        <h4>
          {{productBaseParams.name}}
        </h4>
      </el-row>
      <el-row>
        <span>
          ￥{{productBaseParams.price}}元
        </span>
        
        <el-button class="right-float" size='small'>
          降价通知
        </el-button>
      </el-row>
      <el-row>
        商品数量:<span class="withBrd" @click='delNum()'>-</span>
        <input type="number" class="proNum"  v-model="number" ref='numIpt' min="1" max='productBaseParams.totalcount'>
        <span class="withBrd" @click='addNum()' >+</span>
        <p>
          <el-button type='success' @click='addShopcarrecord(true)'>立即购买</el-button>
          <el-button type='info' @click='addShopcarrecord(false)'>加入购物车</el-button>
        </p>
      </el-row>
    </el-row>
    <el-row class="hidden-xs" v-if='isPad'>
      <el-col :xs='16' :sm='14'>
        <el-row>
          <el-col :span='24'>
            <img :src="productImgs[0]" class="img-response" alt="">
          </el-col>
          <el-col :span='6' :gutter='10' v-for='item in productImgs'>
            <img :src="item" alt="" class="img-response">
          </el-col>
        </el-row>
      </el-col>

       <el-col :xs='8' :sm='10' class='textDsc'>
        <h5>
          {{productBaseParams.name}}
        </h5>
        <p>
          ￥{{productBaseParams.price}}元
          <el-button size='small'>降价通知</el-button>
        </p>
        <p>
          商品数量:<span class="withBrd" @click='delNum()'>-</span>
          <input type="number" class="proNum" v-model='number' ref='numIpt' min="1" :max="productBaseParams.totalcount">
          <span class="withBrd" @click='addNum()'>+</span>
        </p>
        <p>
          <el-button type='success'  @click='addShopcarrecord(true)'>立即购买</el-button>
          <el-button type='info' @click='addShopcarrecord(false)'>加入购物车</el-button>
        </p>
      </el-col> 
    </el-row>
    <el-tabs>
      <el-tab-pane label='产品特征'>
        <img v-for="item in productSpecialImgs" :src="item" alt="" class="img-response">
      </el-tab-pane>
      <el-tab-pane label='技术参数' class="jsParams">
        <ul v-for='item in productJishuParams '>
          <li class='liTh'>
            {{item.thName}}
          </li>
          <li v-for='params in item.contents' class='liWithBg'>
            <span class="hasBrd text-right textOverWithElls">{{params.columnName}}</span>
            <span class="text-left textOverWithElls">{{params.val}}</span>
          </li>
        </ul>
      </el-tab-pane>
      <el-tab-pane label='客户评价'>
        <ul>
          <li v-for='item in productComment.contents' class="cmdLi">
            <p>{{item.content}}</p>
            <p class="nameAndDate">
              <span>{{item.name}}</span>
              <span>{{item.date}}</span>
            </p>
          </li>
        </ul>
      </el-tab-pane>
      <el-tab-pane label='服务' class="serviceETP">
        <b>正品行货</b>
        <p>长虹官方商城向您保证所售商品均为长虹正品，由长虹旗下电商公司“四川智易家网络科技有限公司”开具机打发票或电子发票。</p>
        <b>全国联保</b>
        <p>凭发票可享受全国联保服务，与您亲临商场选购的商品享受相同的质量保证，请您放心购买！</p>
        <b>厂家服务</b>
        <p>长虹官方商城销售并发货的商品，由长虹旗下产品公司提供相应的售后服务，请您放心购买。</p>
        <p>售后服务电话：</p>
        <p>400-811-1666：电视、空调、冰洗、空气净化器、养生壶、厨卫产品等</p>
        <p>400-856-8855：LED灯具等</p>
        <p> 0816-2410821：电池、七彩魔音、幻影手电筒等 </p>
      </el-tab-pane>
    </el-tabs>
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
      isPad:true,
      number:1,
      productImgs:[],
      productSpecialImgs:[],
      // productImgs:[
      //   '/static/tv-small-01.jpg',
      //   '/static/tv-small-02.jpg',
      //   '/static/tv-small-03.jpg',
      //   '/static/tv-small-04.jpg'
      // ],
      productBaseParams:{
        name:'65Q3A 65英寸 4K曲面 OLED有机自发光电视',
        price:'23997.00',
        totalcount:10
      },
      // productSpecialImgs:[
      //   '/static/productSpecialImg01.jpg',
      //   '/static/productSpecialImg02.jpg',
      //   '/static/productSpecialImg03.jpg',
      //   '/static/productSpecialImg04.jpg',
      //   '/static/productSpecialImg05.jpg',
      //   '/static/productSpecialImg06.jpg',
      //   '/static/productSpecialImg07.jpg',
      //   '/static/productSpecialImg08.jpg',
      //   '/static/productSpecialImg09.jpg'
      // ],
      productJishuParams:[
      {
          thName:"主体参数",
          contents:
          [
            {columnName:'产品名称',val:'65Q3A 65英寸 4K曲面 OLED有机自发光电视'},
            {columnName:'产品型号',val:'65Q3A'},
            {columnName:'颜色',val:'银色'},
            {columnName:'品牌名称',val:'长虹(CHANGHONG)'},
            {columnName:'屏幕尺寸(英寸)',val:'65'},
            {columnName:'上市时间',val:'2016-10-16 00-00-00'},
            {columnName:'最佳观看距离',val:'3-3.5米'}
          ]
      },
      {
          thName:"显示参数",
          contents:
          [
            {columnName:'支持高清格式',val:'2160P/1080P/720P/1080i'},
            {columnName:'是否支持3D显示',val:'是'},
            {columnName:'分辨率',val:'3840*2160'},
            {columnName:'亮度',val:'730cd/m'},
            {columnName:'刷屏率',val:'60'},
            {columnName:'扫描方式',val:'逐行扫描'},
            {columnName:'响应时间',val:'<=8ms'},
            {columnName:'屏幕比例',val:'16:9'}
          ]
      },
      { 
          thName:"核心参数",
          contents:
          [
            {columnName:'CPU',val:'强劲64位4核A53 4K电视专用芯'},
            {columnName:'GPU',val:'高性能双核Mali-T860 4K图像处理器'},
            {columnName:'操作系统',val:'3840*2160'},
            {columnName:'内部存储空间',val:'8GB高速闪存'}
          ]
      },
      {
        thName:"音频参数",
        contents:
        [
          {columnName:'音频系统',val:'DTS音箱系统、杜比音响系统'},
          {columnName:'音频模式',val:'5段均衡/平衡、智能音量控制'},
          {columnName:'输出功率(w)',val:'2*9w'},
          {columnName:'扬声器数量',val:'2'}
        ]
      },
      {
        thName:"USB支持格式",
        contents:
        [
          {columnName:'USB支持视频格式',val:'2K:MPEG-2、MPEG-4、H.264/H.265、RM/RMVB等。4K：主流4KH.265、TS格式等'},
          {columnName:'USB支持音频格式音频模式',val:'MPEG1/2 Layer1/2、MP3、Dolby（AC-3）、wma、wav等'},
          {columnName:'USB支持图片格式',val:'JPG、PNG、BMP等'}
        ]
      }
    ],
    productComment:{
        contents:
        [
          {name:"阿三",content:"屏幕超清晰",date:'2017-02-13'},
          {name:"棒子",content:"曲屏还是蛮潮的！",date:'2017-03-23'},
          {name:"欧巴",content:"有点小贵",date:'2017-04-11'}
        ]
      }
    }
  },
  mounted:function(){
    let width=parseInt(window.innerWidth);
    if(width>=768){
       return this.isPad=true;
    }else{
      this.isPad;
      return this.isPad=false;
    }
  },
  created:function(){
    let xhr =new XMLHttpRequest();
    let self=this;
    xhr.open("get","http://localhost/palmstore/data/productdetailcrlimgs.php?pid="+this.$route.params.productId,true);
    xhr.onreadystatechange=function(){
      if(xhr.readyState==4&&xhr.status==200){
        let response = JSON.parse(xhr.responseText);
        if(response.code==undefined){
          for(let i=0;i<response.length;i++){
            console.log(response[i].pic);
            console.log(this);
            self.productImgs.push(response[i].pic);
          }
        }else{
          alert("服务器维护，给你购物带来不便，敬请谅解");
        }
      }
    };
    xhr.send();

    let getSpecialImgsxhr = new XMLHttpRequest();
    getSpecialImgsxhr.open("get","http://localhost/palmstore/data/productdetailsplimgs.php?pid="+this.$route.params.productId,true);
    getSpecialImgsxhr.onreadystatechange=function(){
      if(getSpecialImgsxhr.readyState==4&&getSpecialImgsxhr.status==200){
        let response = JSON.parse(getSpecialImgsxhr.responseText);
        if(response.code==undefined){
          for(let i=0;i<response.length;i++){
            self.productSpecialImgs.push(response[i].pic);
          }
        }else{
          alert("服务器维护，给你购物带来不便，敬请谅解");
        }
      }
    };
    getSpecialImgsxhr.send();
  },
  methods:{
    delNum(){
      if(this.number){
        return this.number--;
      }
      // let iptNode = this.$refs.numIpt;
      // let num =parseInt(iptNode.value);
      // console.log(iptNode);
      // if(num>0){
      //   iptNode.value=num-1;
      // }
    },
    addNum(){
      if(this.number<this.productBaseParams.totalcount){
        return this.number++;
      }
      // let iptNode = this.$refs.numIpt;
      // let num =parseInt(iptNode.value);
      // if(num<this.productBaseParams.totalcount){
      //   iptNode.value=num+1;
      // }
    },
    addShopcarrecord(flag){
      let userid=window.sessionStorage.getItem("userid");
      let self = this;
      console.log("detail page "+userid);
      if(userid!==null){
        let xhr = new XMLHttpRequest();
        xhr.open("post","http://localhost/palmstore/data/addShopRecord.php",true);
        xhr.onreadystatechange=()=>{
          if(xhr.readyState==4&&xhr.status==200){
            let response =JSON.parse(xhr.responseText);
            console.log(response);
            if(response.code==1){
              if(flag){
                console.log("即将跳往购物车");
                self.$router.push({name:'shopcar',params:{"userid":userid}});
              }
            }
          }
        }
        xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        xhr.send("userid="+userid+"&pid="+this.$route.params.productId+"&salecount="+this.number);
      }else{
        alert("请先登录");
      }
    }
  },
  watch:{
    "number":function(val,oldval){
      if(isNaN(val)){
        return this.number=oldval;
      }else if(!parseInt(val)){
        this.number=oldval;
      }else if(parseInt(val)<0){
        this.number=oldval;
      }
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  *{
    box-sizing: border-box;
  }
  .detailDiv{
    margin-top:20px;
    margin-bottom:10px;
    /* border:1px solid red; */
  }
  @media (min-width:768px){
    .textDsc{
      position: relative;
      top:120px;
    }
  }
 
.withBrd{
  display: inline-block;
  width:30px;
  height:30px;
  padding:5px;
  border:1px solid #dddddd;
}
.proNum{
  width:50px;
  height:40px;
}
.withBrd,.proNum{
  text-align: center;
}
.hasBrd{
  border-right: 1px solid #dddddd;
}
.text-right{
  display: inline-block;
  width:20%;
  text-align: right;
}
.liWithBg{
  border: 1px solid #dddddd;
}
.jsParams ul+ul{
  margin-top:20px;
}
@media (max-width:767px){
  .text-right{
    display: inline-block;
    width:30%;
    text-align: right;
    font-size:10px;
  }
  .text-left{
    display: inline-block;
    width:68%;
    text-align: left;
    font-size:10px;
  }
}
.cmdLi{
  border-top:1px solid #dddddd;
  border-bottom:1px solid #dddddd;
}
.nameAndDate{
  text-align: right;
}
.serviceETP b{
  color:red;
  font-size:18px;
}
</style>

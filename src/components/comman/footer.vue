<template>
  <div class="footerDiv">
    <el-row id="otherSpans">
      <el-col :span='8'>
        <span class="iSpan shopCar" id="shopCar" ref="shopcar" v-on:click='goToSC()'></span> <label for="shopCar">购物车</label>
      </el-col> 
      <el-col :span='8' v-if="!loginStatus">
        <span class="iSpan unload" id="unlogin" @click="showLog()"></span>  <label for="unlogin" >登录</label> 
      </el-col> 
      <el-col :span='8' v-if="loginStatus" class="userEC" @blur="personOptHidden()">
        <span class="iSpan logined" id="logined" @click="loginedShow()"></span>
        <ul ref="personOpt" id="loginedUl" >
          <li>注销</li>
          <li>个人中心</li>
        </ul>
      </el-col> 
      <el-col :span='8'>
        <span class="iSpan regist" id="regSpan" @click="showReg()"></span><label for="regSpan">注册</label>
      </el-col> 
    </el-row>
    <login id='lgAndReg' ref='lgAndReg' :message='isLogin' @submitLoginStatus="changeLoginStatus">
    
    </login>
  </div>
</template>

<script>
import login from '@/components/comman/login'
export default {
  name: 'hello',
  components:{
    login
  },
  data () {
    return {
      isLogin:true,
      loginStatus:false,
      msg: 'Welcome to Your Vue.js App'
    }
  },
  mounted:function(){
    if(window.sessionStorage.getItem("userid")!==null){
      this.loginStatus=true;
    }
  }
  ,
  methods:{
    goToSC(){
      let id=window.sessionStorage.getItem("userid");
      console.log("点击购物车"+id);
      if(id==null){
        alert("请先登录");
      }else{
        console.log("即将跳转");
        this.$router.push({name: 'shopcar', params:{"userid":id}});
      }
      //this.$router.push({path: '/shopcar', query:{userid: "12"}});
    },
    showLog(){
      let logNode=this.$children[1].$refs.lg;
      let divNode=this.$refs.lgAndReg;
      logNode.$el.className='el-tabs__item is-active';
      document.getElementsByClassName("el-tabs__nav")[0].childNodes[1].className="el-tabs__item is-active";
      document.getElementsByClassName("el-tabs__nav")[0].childNodes[2].className="el-tabs__item ";
      divNode.$el.style.display='block';
      return this.isLogin=true;
    },
    showReg(){
      let regNode=this.$children[1].$refs.reg;
      let divNode=this.$refs.lgAndReg;
      document.getElementsByClassName("el-tabs__nav")[0].childNodes[1].className="el-tabs__item ";
      document.getElementsByClassName("el-tabs__nav")[0].childNodes[2].className="el-tabs__item is-active";
      divNode.$el.style.display='block';
      return this.isLogin=false;
    },
    loginedShow(){
      let ulNode =this.$refs.personOpt;
      console.dir(ulNode);
      ulNode.style.display="block";
    },
    changeLoginStatus(...data){
      console.log("data="+data);
      return this.loginStatus=data[0];
    },
    personOptHidden(){
      console.log(111);
      let ulNode =this.$refs.personOpt;
      console.dir(ulNode);
      ulNode.style.display="none";
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
   #otherSpans{
    position: fixed;
    padding-top:10px;
    padding-bottom:10px;
    bottom: 0px;
    width:100%;
    background: #fff;
    opacity: .7
  }
  #otherSpans label{
    display: inline-block;
    position: relative;
    top:-15px;
  }
  .userEC{
    position: relative;
  }
  #loginedUl{
    position: absolute;
    top:-100%;
    right:0px;
    width:100%;
    display: none;
    margin:0px;
    background: #dddddd;
  }
  #loginedUl li{
    list-style: none;
    text-align:center;
  }
  .iSpan{
    display: inline-block;
    width:40px;
    height:40px;
  }
  .unload{
    background: url('/static/unload.png')
  }
  .logined{
    background: url('/static/logined.png')
  }
  .regist{
    background: url('/static/reg.png')
  }
  .shopCar{
    background: url('/static/unshop.png')
  }
  .el-row .el-col{
    text-align: center
  }
</style>

<template>
  <div class="loginDiv">
      <el-row >
          <el-col :xs='20' :sm='12' class="lrDiv" ref='lrDiv'>
                <el-tabs>
                    <el-tab-pane label='登录' ref='lg' >
                        <el-form :model="loginForm"  ref="loginForm"  class="demo-ruleForm" >
                            <el-form-item >
                                <el-input v-model="loginForm.username"  placeholder='输入用户名'></el-input>
                            </el-form-item>
                            <el-form-item >
                                <el-input type="password" v-model="loginForm.userpwd" placeholder='输入密码'></el-input>
                            </el-form-item>
                            <el-form-item >
                                <el-button type="primary" @click="login()">登录</el-button>
                            </el-form-item>
                        </el-form>
                    </el-tab-pane>

                    <el-tab-pane label='注册' ref='reg'  >
                        <el-row >
                            <el-row>
                                <el-input v-model="regForm.username" placeholder='输入用户名' ref='regun'></el-input>
                            </el-row>
                            <el-row>
                                <el-input type="password" v-model="regForm.userpwd" placeholder='输入密码' ref='regpwd'></el-input>
                            </el-row>
                            <el-row>
                                <el-input type="password" v-model="regForm.reuserpwd" placeholder='确认密码' ref='regrpwd' id="regrpwd"></el-input>
                            </el-row>
                            <el-row>
                                <el-button type="primary"  @click="submitForm(regForm)" class="regBtn">注册</el-button>
                                <el-button @click="resetForm(regForm)" class="regBtn">重置</el-button>
                            </el-row>
                        </el-row>
                       
                        <!-- <el-form :model="regForm"  ref="regForm" class="demo-ruleForm">
                            <el-form-item  >
                                
                            </el-form-item>
                            <el-form-item  >
                                
                            </el-form-item>
                             <el-form-item  ref='regrpwd'>
                               
                            </el-form-item>
                            <el-form-item >
                                
                            </el-form-item>
                        </el-form> -->
                    </el-tab-pane>
                </el-tabs>
                <span id="closeLr" @click="closeLr()">
                    &times;
                </span>
          </el-col>
      </el-row>
  </div>
</template>

<script>

import axios from 'axios';
export default {
  props:["message"],
  data () {
    return {
        labelPosition:'left',
        loginForm:{
            username:"",
            userpwd:""
        },
        regForm:{
            username:'',
            userpwd:'',
            reuserpwd:''
        },
        regRules:[],
        loginRules:[],
        isLogin:true
    }
  },
  watch:{
    "message":function(){
        return this.isLogin=this.message;
    }
  },
  methods:{
      closeLr(){
          document.getElementsByClassName("loginDiv")[0].style.display='none';
      },
      submitForm(regForm){
          if(this.checkInfo()){
            let xhr  = new XMLHttpRequest();
            xhr.open("post", "http://localhost/palmstore/data/userreg.php",true);
            xhr.onreadystatechange=function(){
                if(xhr.readyState==4&&xhr.status==200){
                    let response = JSON.parse(xhr.responseText);
                    console.dir(response);
                    if(response.code==1){
                        alert("注册成功");
                    }else if(response.code==-1){
                        console.log(response);
                        alert("服务器故障");
                    }else if(response.code==-5){
                        this.$refs.regun
                        alert("用户已注册");
                    }
                }
            }
            xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            xhr.send("username="+this.regForm.username+'&userpwd='+this.regForm.userpwd);
          }
          
        // console.log("调用注册函数");
        // let script = document.createElement("script");
        // //let script = document.createElement("script");
        // script.src = "http://localhost/palmstore/data/userreg.php?username="+this.regForm.username+'&userpwd='+this.regForm.userpwd+"&callback=process";
        // document.head.appendChild(script);
       
        
        // 及时删除，防止加载过多的JS
       // document.head.removeChild(script);

        // axios.post('/static/data/userreg.php', {
        // axios.post('/palmstore/data/login.php', {
        //     username: regForm.username,
        //     userpwd: regForm.userpwd
        // })
        // .then(function (response) {
        //     console.log(response);
        // })
        // .catch(function (response) {
        //     console.log(response);
        // });
      },
    process(data){
        console.log(data);
    },
    checkInfo(){
        if(this.regForm.userpwd!=this.regForm.reuserpwd){
            console.dir(this.$refs);
            console.dir(this.$refs.regrpwd);
            let regPwdNode=this.$refs.regrpwd.$el;
            console.dir(regPwdNode);

              console.log(this.$refs.regrpwd.value);
              this.$refs.regrpwd.$el.childNodes[2].focus();
            //document.getElementById("regrpwd").focus();
            //regPwdNode.focus();
            return false;
        }
        return true;
    },
    changeIsLogin(flag){
        //return this.isLogin=flag;
    },
    login(){
        console.log("开始调用login函数");
        let xhr = new XMLHttpRequest();
        var t=this;
        xhr.open("post","http://localhost/palmstore/data/userlogin.php",true);
        xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        xhr.onreadystatechange=function(){
            if(xhr.readyState==4&&xhr.status==200){
                let response = JSON.parse(xhr.responseText);
                if(response.code==undefined){
                    //let lgNode =this.childNodes[0]
                    console.log(window.sessionStorage.getItem("userid"));
                    window.sessionStorage.setItem("userid",response.userid);
                    console.log(window.sessionStorage.getItem("userid"));
                    t.$el.style.display="none";
                    t.$emit("submitLoginStatus",[true]);
                    //return t.loginStatus=true;
                }else{
                    if(response.code==-1){
                        t.$emit("submitLoginStatus",[false]);
                        //return t.loginStatus=false;
                    }
                    
                }
            }
        }
        xhr.send("username="+this.loginForm.username+"&password="+this.loginForm.userpwd);
    }

  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.loginDiv{
  position: fixed;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  background: rgba(0,0,0, .7);
  z-index: 999;
  display:none;
}
.lrDiv{
    position: relative;
     height:400px;
}
@media (max-width:767px){
    .lrDiv{
        margin-left:4.25%;
        margin-top:100px;
    }
}
@media (min-width:768px) and (max-width:990px){
    .lrDiv{
        margin-left:25%;
        margin-top:300px;
    }
}
.el-tabs{
    height:100%;
    border: 1px solid greenyellow; 
    padding:20px;
}

.btnCenter{
    text-align: center;
}
#closeLr{
    position: absolute;
    top:-15px;
    right:-15px;
    width:30px;
    height:30px;
    font-size:30px;
    color:red;
    text-align: center;
    line-height: 30px;
    /* border:1px solid red; */
}
.regBtn{
    height:40px;
}
</style>

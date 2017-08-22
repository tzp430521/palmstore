<template>
  <div class="pub">
    <el-row class="head-top-row">
        <el-col :xs='6' :sm="4" :offset='1'>
          <img src="/static/logo.png" class='img-response' alt="">
        </el-col>

        <el-col :xs='18' :sm="8" id="searchEc">
          <el-input
            placeholder="输入关键字"
            icon="search"
            v-model="searchKyeWord"
            :on-icon-click="handleIconClick"
            id="searchIpt">
          </el-input>
          <ul v-show="searchKyeWord" id="info">
            <li v-for="item in resultBySKW"  ref="schItem">{{item}}</li>
          </ul>
        </el-col>

    </el-row>
  </div>
</template>

<script>
export default {
  name: 'pub',
  data () {
    return{
      showModule:false,
      searchKyeWord:"",
      resultBySKW:['洗衣机','高压锅','电饭煲']
    }
  },
  methods:{
      handleIconClick(){

      },
      changeTextColor(){
        console.log("触发函数");
        this.style.color="red";
      }
  },
  mounted:function(){
    var liNodes=this.$refs.schItem;
    for(let i=0;i<liNodes.length;i++){
      liNodes[i].addEventListener('mouseover',
      ()=>{
                console.log(liNodes[i].innerHTML);
            })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.pub{
  position: fixed;
  top:0px;
  z-index: 100;
  width:100%;
  background: #fff;
  opacity: .7
}
h1, h2 {
  font-weight: normal;
}
.el-row,.el-col{
  margin:0px;
}
ul,li{
  margin:0px;
  padding:0px;
}
a {
  color: #42b983;
}

#searchEc{
  position: absolute;
  top:0px;
  right:0px;
}
.head-top-row .el-col{
  position: relative;
}
#info{
  position: absolute;
  z-index: 100;
  width:100%;
  background-color:#dddddd
}
#info li{
  list-style: none;
  text-align: left;
  padding:10px;
  border-bottom: 1px solid #333333
}
</style>

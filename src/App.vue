<template>
  <div id="app">
    <router-view></router-view>
    <myfooter></myfooter>  
  </div>
</template>

<script>
import myfooter from '@/components/comman/footer';
export default {
  name: 'app',
  components: {
      myfooter
  }
}
</script>

<style>
*{
  text-align: left;
}
body,ul,li{
  padding:0px;
  margin:0px;
}
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 20px;
}
@media (max-width: 767px) {
  .hidden-xs {
    display: none !important;
  }
}
@media (min-width:768px){
  .hidden-sm{
    display: none !important;
  }
}
.img-response{
  display: block;
  max-width: 100%;
}
.right-float{
  float:right;
}
.left-float{
  float:left;
}
.clear-float{
  clear:both;
}
.textOverWithElls{
  white-space: nowrap;
  overflow: hidden;
  -ms-text-overflow: ellipsis;
  -o-text-overflow: ellipsis;
  text-overflow: ellipsis;
}
text-left{
  text-align: left;
}
a{
  text-decoration: none;
}
</style>

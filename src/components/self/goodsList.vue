<template>
  <div class="goodsListDiv">
    <top></top>
    <el-row>
        <el-col :span="24">
            <!-- <ul class="glDivCrlUl" ref="glDivCrlUl">
                <li v-for="item in caresoulItems" class="left-float">
                    <img :src="item.pic" class="img-response" alt="" ref='crlImg'>
                </li>
            </ul> -->
             <el-carousel id="elCrl" >
                <el-carousel-item v-for="item in caresoulItems" :key="item" >
                    <img :src="item.pic" class="img-response" alt="" ref='crlImg'>
                </el-carousel-item>
            </el-carousel> 
        </el-col>
    </el-row>
    
    <el-row id="pdtsER">
         <el-col :xs="6" :sm="6"  >
            <router-link :to="{ name: 'category', params: { category: 1 }}">
                <span class="pSpan chiqP" id="chiqP"></span> <label for="chiqP">启客系列</label>
            </router-link>
        </el-col>

        <el-col :xs="6" :sm="6"  >
            <router-link :to="{ name: 'category', params: { category: 2 }}">
                <span class="pSpan tv" id="tv"></span> <label for="tv">平板电视</label>
            </router-link>
        </el-col>

        <el-col :xs="6" :sm="6" >
            <router-link :to="{ name: 'category', params: { category: 3 }}">
                <span class="pSpan air" id="air"></span> <label for="air">空调产品</label>
            </router-link>
        </el-col>

        <el-col :xs="6" :sm="6"  >
            <router-link :to="{ name: 'category', params: { category: 4}}">
                <span class="pSpan icebox" id="icebox"></span> <label for="icebox">美菱冰洗</label>
            </router-link>
        </el-col>

        <el-col :xs="6" :sm="6"  >
            <router-link :to="{ name: 'category', params: { category: 5 }}">
                <span class="pSpan ele" id="ele"></span> <label for="ele">生活家电</label>
            </router-link>
        </el-col>

        <el-col :xs="6" :sm="6" >
            <router-link :to="{ name: 'category', params: { category: 6 }}">
                <span class="pSpan digital" id="digital"></span> <label for="digital">数码影音</label>
            </router-link>
        </el-col>

        <el-col :xs="6" :sm="6">
            <router-link :to="{ name: 'category', params: { category: 7 }}">
                <span class="pSpan other" id="other"></span> <label for="other">周边其它</label>
            </router-link>
        </el-col>
    </el-row>
    
    <el-row>
        <el-row>
            <el-col :span="24" id="tvTitle">
                <span  >电视产品</span>
                <router-link :to="{ name: 'detail', params: { productId: 1 }}">
                    查看更多&gt;&gt;
                </router-link>
            </el-col>
            <el-col :sm="6" class="hidden-xs">
                <router-link :to="{ name: 'detail', params: { productId:1}}">
                    <img src="/static/tvAd.jpg" class="img-response" alt="">
                </router-link>
            </el-col>
           <el-col :xs="12" :sm="6" v-for='good in dianshi' >
                <router-link :to="{ name: 'detail', params: { productId: good.pid }}">
                    <img :src="good.pic" alt="">
                    <p><span>{{good.name}}</span></p>
                    <p><span>￥{{good.price}}元</span></p>
                </router-link>
            </el-col>
        </el-row>
    </el-row>

    <el-row>
        <el-row>
            <el-col :span="24" id="iceboxTitle">
                <span  >美菱冰洗</span>
                <router-link :to="{ name: 'detail', params: { productId: 1 }}">
                    查看更多&gt;&gt;
                </router-link>
            </el-col>
            <el-col :sm="6" class="hidden-xs">
                <router-link :to="{ name: 'detail', params: { productId:1}}">
                    <img src="/static/iceboxAd.jpg" class="img-response" alt="">
                </router-link>
            </el-col>
           <el-col :xs="12" :sm="6" v-for='good in bingxiang' >
                <router-link :to="{ name: 'detail', params: { productId: good.pid }}">
                    <img :src="good.pic" alt="">
                    <p><span>{{good.name}}</span></p>
                    <p><span>￥{{good.price}}元</span></p>
                </router-link>
            </el-col>
        </el-row>
    </el-row>

     <el-row>
        <el-row>
            <el-col :span="24" id="airTitle">
                <span  >空调产品</span>
                <router-link :to="{ name: 'detail', params: { productId: 1 }}">
                    查看更多&gt;&gt;
                </router-link>
            </el-col>
            <el-col :sm="6" class="hidden-xs">
                <router-link :to="{ name: 'detail', params: { productId:1}}">
                    <img src="/static/airAd.jpg" class="img-response" alt="">
                </router-link>
            </el-col>
           <el-col :xs="12" :sm="6" v-for='good in kongtiao' >
                <router-link :to="{ name: 'detail', params: { productId: good.pid }}">
                    <img :src="good.pic" alt="">
                    <p><span>{{good.name}}</span></p>
                    <p><span>￥{{good.price}}元</span></p>
                </router-link>
            </el-col>
        </el-row>
    </el-row>

    <el-row>
        <el-row>
            <el-col :span="24" id="otherTitle">
                <span  >其他产品</span>
                <router-link :to="{ name: 'detail', params: { productId: 1 }}">
                    查看更多&gt;&gt;
                </router-link>
            </el-col>
            <el-col :sm="6" class="hidden-xs">
                <router-link :to="{ name: 'detail', params: { productId:1}}">
                    <img src="/static/other01.jpg" class="img-response" alt="">
                </router-link>
            </el-col>
           <el-col :xs="12" :sm="4"  v-for='good in otherProducts' >
                <router-link :to="{ name: 'detail', params: { productId: good.pid }}">
                    <img :src="good.pic" alt="">
                    <p><span>{{good.name}}</span></p>
                    <p><span>￥{{good.price}}元</span></p>
                </router-link>
            </el-col>
        </el-row>
    </el-row>
    <!-- <el-row>
        <el-col :span='6' class="text-left">
            <el-row>
                <el-col :span="24">
                    <span id='tvTitle'>电视产品</span>
                    <router-link :to="{ name: 'detail', params: { productId: 1 }}">
                        查看更多&gt;&gt;
                    </router-link>
                </el-col>
                <el-col :span='24'>
                    <img src="/static/tvAd.jpg"  class="img-response" alt="">
                </el-col>
            </el-row>
        </el-col>
        <el-col :span='18'>
            <el-row>
                <el-col :xs="8" :sm="8" v-for='good in dianshi' >
                    <router-link :to="{ name: 'detail', params: { productId: good.pid }}">
                        <img :src="good.pic" alt="">
                        <p><span>{{good.name}}</span></p>
                        <p><span>'￥'{{good.price}}"元"</span></p>
                    </router-link>
                </el-col>
            </el-row>
        </el-col>
    </el-row> -->

    <!-- <el-tabs>
      <el-tab-pane label="冰箱">
        <el-row>
          <el-col :xs="12" :sm="8" v-for='good in bingxiang' >
              <router-link :to="{ name: 'detail', params: { productId: good.pid }}">
                <img :src="good.pic" alt="">
                <p><span>{{good.name}}</span></p>
                <p><span>'￥'{{good.price}}"元"</span></p>
              </router-link>
          </el-col>
        </el-row>
      </el-tab-pane>
      <el-tab-pane label="空调">
        <el-row>
          <el-col :xs="12" :sm="8" v-for='good in kongtiao' >
              <router-link :to="'detail'">
                <img :src="good.pic" alt="">
                <p><span>{{good.name}}</span></p>
                <p><span>'￥'{{good.price}}"元"</span></p>
              </router-link>
          </el-col>
        </el-row>
      </el-tab-pane>
      <el-tab-pane label="电视">
        <el-row>
          <el-col :xs="12" :sm="8" v-for='good in dianshi' >
              <router-link :to="'detail'">
                <img :src="good.pic" alt="">
                <p><span>{{good.name}}</span></p>
                <p><span>'￥'{{good.price}}"元"</span></p>
              </router-link>
          </el-col>
        </el-row>
      </el-tab-pane>
      <el-tab-pane label="其它">

      </el-tab-pane>
    </el-tabs> -->
  </div>
</template>

<script>
  import top from '@/components/comman/header';
  export default {
    name: 'goodsList',
    components:{
        top
    },
    data() {
     return {
        caresoulItems:[
        {
            pic:'/static/caresoul01.jpg',
        },
        {
            pic:'/static/caresoul02.png',
        },
        {
            pic:'/static/caresoul03.jpg',
        },
        {
            pic:'/static/caresoul04.jpg',
        },
        {
            pic:'/static/caresoul05.jpg',
        }
        ],
        typeNames:['启客系列','平板电视','空调产品','美菱冰箱','生活家电','数码影音','周边其它']
        ,
        productTypes:[
        {
           type:1,
           pic:"/static/chiq.png"
        },
        {
           type:2,
           pic:"/static/tv.png"
        },
        {
           type:3,
           pic:"/static/air.png"
        },
        {
           type:4,
           pic:"/static/icebox.png"
        },
        {
           type:5,
           pic:"/static/ele.png"
        },
        {
           type:6,
           pic:"/static/digital.png"
        },
        {
           type:7,
           pic:"/static/other.png"
        },
        ],
        bingxiang:[
        {
            pic:'/static/bingxiang1.jpg',
            price:3300,
            name:'冰箱1号',
            pid:1
        },
        {
            pic:'/static/bingxiang2.jpg',
            price:3300,
            name:'冰箱2号',
            pid:2
        },
        {
            pic:'/static/bingxiang3.jpg',
            price:3300,
            name:'冰箱3号',
            pid:3
        },
        {
            pic:'/static/bingxiang4.jpg',
            price:3300,
            name:'冰箱4号',
            pid:4
        },
        {
            pic:'/static/bingxiang5.jpg',
            price:3300,
            name:'冰箱5号',
            pid:5
        },
        {
            pic:'/static/bingxiang6.jpg',
            price:3300,
            name:'冰箱6号',
            pid:6
        }],
        kongtiao:[
        {
            pic:'/static/kongtiao1.jpg',
            price:3300,
            name:'空调1号',
            pid:7
        },
        {
            pic:'/static/kongtiao2.jpg',
            price:3300,
            name:'空调2号',
            pid:8
        },
        {
            pic:'/static/kongtiao3.jpg',
            price:3300,
            name:'空调3号',
            pid:9
        },
        {
            pic:'/static/kongtiao4.jpg',
            price:3300,
            name:'空调4号',
            pid:10
        },
        {
            pic:'/static/kongtiao5.jpg',
            price:3300,
            name:'空调5号',
            pid:11
        },
        {
            pic:'/static/kongtiao6.jpg',
            price:3300,
            name:'空调6号',
            pid:12
        }
        ],
        dianshi:[
        {
            pic:'/static/dianshiji1.jpg',
            price:3300,
            name:'电视1号',
            pid:1
        },
        {
            pic:'/static/dianshiji2.jpg',
            price:3300,
            name:'电视2号',
            pid:14
        },
        {
            pic:'/static/dianshiji3.jpg',
            price:3300,
            name:'电视3号',
            pid:15
        },
        {
            pic:'/static/dianshiji4.jpg',
            price:3300,
            name:'电视4号',
            pid:16
        },
        {
            pic:'/static/dianshiji5.jpg',
            price:3300,
            name:'电视5号',
            pid:17
        },
        {
            pic:'/static/dianshiji6.jpg',
            price:3300,
            name:'电视6号',
            pid:18
        }
        ],
        otherProducts:[
        {
            pic:'/static/other02.jpg',
            price:3300,
            name:'电视2号',
            pid:20
        },
        {
            pic:'/static/other03.jpg',
            price:3300,
            name:'电视3号',
            pid:21
        },
        {
            pic:'/static/other04.jpg',
            price:3300,
            name:'电视4号',
            pid:22
        },
        {
            pic:'/static/other05.jpg',
            price:3300,
            name:'电视5号',
            pid:23
        }
        ]
    }
    },
    mounted:function(){
        let num=1;
        let width = parseInt(window.innerWidth);
        //let crlNode =this.$refs.glDivCrlUl;
        let crlNode =document.getElementsByClassName("glDivCrlUl")[0];
        console.dir(crlNode);
        console.log(width);
        let timer=setInterval(function(){
            let crlNode =document.getElementsByClassName("glDivCrlUl")[0];
            // console.dir(crlNode);
            // crlNode.scrollWidth-=num*width+"px";
            // console.log(crlNode.style.left);
        },10000);
    }
  }

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>
/* .el-carousel__container{
    height:"" !important;
} 
.el-carousel__item,.el-carousel__mask{
    height:"" !important;
}  */
</style>
<style scoped>
    .goodsListDiv{
        margin-top: 40px;
    }
@media (max-width: 767px) {
    .goodsListDiv{
        margin-top: 40px;
    }
}
  .glDivCrlUl{
    position: relative;
    left:0px;
    width:500%;
    overflow: hidden;
  }
  .glDivCrlUl li{
    width:20%;
  }
  .el-row{
      margin-top:10px;
  }
  .el-col{
      text-align: center;
  }
  .el-col p{
      text-align: center;
  }
  .text-left {
      text-align: left !important;
  }
  a {
    text-decoration: none
  }
  #pdtsER{
    background:#959898
  }
  .pSpan{
      display: inline-block;
      width:50px;
      height:50px;
  }
  #pdtsER label{
      display: inline-block;
      position: relative;
      top:-15px;
      color:white;
  }
  .chiqP{
      background: url('/static/chiq.png')
  }
  .tv{
      background: url('/static/tv.png')
  }
  .air{
      background: url('/static/air.png')
  }
  .icebox{
      background: url('/static/icebox.png')
  }
  .ele{
      background: url('/static/ele.png')
  }
  .digital{
      background: url('/static/digita.png')
  }
  .other{
      background: url('/static/other.png')
  }

  #tvTitle,#iceboxTitle,#airTitle,#otherTitle{
      display: inline-block;
      border-left: 4px solid #CA694E;
      padding-left:15px;
      text-align: left;
  }

</style>
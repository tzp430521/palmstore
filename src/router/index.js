import Vue from 'vue'
import Router from 'vue-router'
import Header from '@/components/comman/header'
import GoodsList from '@/components/self/goodsList'
import Detail from '@/components/self/detail'
import Producttype from '@/components/self/producttype'
import Shopcar from '@/components/self/shopcar'
import Category from '@/components/self/category'
Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'goodsList',
      component: GoodsList
    },
    {
      path: '/detail/:productId',
      name: 'detail',
      component: Detail
    },
    {
      path: '/producttype/:productType',
      name: 'producttype',
      component: Producttype
    },
    {
      path:'/shopcar/:userid',
      name:'shopcar',
      component:Shopcar
    },
    {
      path:'/category/:category',
      name:'category',
      component:Category
    }
  ]
})

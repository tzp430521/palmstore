<template>
    <div class="categoryDiv">
        <otherheader></otherheader>
        <el-row >
            <span class="left-float" id="cgSpan">{{ categoryname+":"}}</span>
            <ul class="left-float">
                <li class="left-float" v-for='(item,index) in type'>
                    <span @click="clk(item.ziname)">{{item.ziname}}</span>
                </li>
            </ul>
            <el-row class="clear-float" id="selectedOption" ref="selectedOption" v-if="selectedOption">
                已选中条件：<span v-model='selectedOption' @click='cclSlcOpt()'>{{selectedOption}}</span>
            </el-row>
        </el-row>
        <el-row v-if="!products.length">

        </el-row>
        <el-row v-if="products.length" >
            <el-col :xs="12" :sm="8" v-for='(item,index) in products' >
                <router-link :to="{ name: 'detail', params: {productId: item.pid}}">
                    <img :src="item.pic" alt="">
                    <p><span>{{item.pname}}</span></p>
                    <p><span>￥{{item.price}}</span></p>
                </router-link>
        </el-col>
        </el-row>
    </div>
</template>
<script>
    import otherheader from '@/components/comman/otherheader';
    export default{
        name:"category",
        components:{
            otherheader
        },
        data () {
            return {
                selectedOption:'',
                categoryname:'',
                products:[],//pic pname price pid 
                type:[]//cgname启客系列 ziname启客电视 
            }
        },
        created:function(){
            let self = this;
            let xhr = new XMLHttpRequest();
            xhr.open("get","http://localhost/palmstore/data/getProductByCategory.php?category="+this.$route.params.category,true);
            xhr.onreadystatechange=function(){
                if(xhr.readyState==4&&xhr.status==200){
                    let response = JSON.parse(xhr.responseText);
                    for(let i=0;i<response.length;i++){
                        self.products.push(response[i]);
                    }
                }
            }
            xhr.send();

            let typeXhr = new XMLHttpRequest();
            typeXhr.open("get","http://localhost/palmstore/data/getProductTypeOfCategory.php?category="+this.$route.params.category,true);
            typeXhr.onreadystatechange=function(){
                if(typeXhr.readyState==4&&typeXhr.status==200){
                    let response = JSON.parse(typeXhr.responseText);
                    for(let i=0;i<response.length;i++){
                        self.type.push(response[i]);
                    }
                    self.categoryname=self.type[0].cgname;
                }
            }
            typeXhr.send();
        },
        methods:{
            //clk：根据条件筛选商品
            clk(item){
                let self = this;
                let typeXhr = new XMLHttpRequest();
                typeXhr.open("get","http://localhost/palmstore/data/getProductsByXLName.php?category="+this.$route.params.category+"&xlname="+item,true);
                typeXhr.onreadystatechange=function(){
                    if(typeXhr.readyState==4&&typeXhr.status==200){
                        self.selectedOption=item;
                        let response = JSON.parse(typeXhr.responseText);
                        self.products=[];
                        if(Response.code!=-1){
                            for(let i=0;i<response.length;i++){
                                self.products.push(response[i]);
                            }
                        }
                    }
                }
                typeXhr.send();
            },
            //cclSlcOpt:取消商品筛选条件
            cclSlcOpt(){
                console.log("开始调用cclSlcOpt");
                let self = this;
                let typeXhr = new XMLHttpRequest();
                typeXhr.open("get","http://localhost/palmstore/data/getProductByCategory.php?category="+this.$route.params.category,true);
                typeXhr.onreadystatechange=function(){
                    if(typeXhr.readyState==4&&typeXhr.status==200){
                        self.selectedOption="";
                        let response = JSON.parse(typeXhr.responseText);
                        self.products=[];
                        if(Response.code!=-1){
                            for(let i=0;i<response.length;i++){
                                self.products.push(response[i]);
                            }
                        }
                    }
                }
                typeXhr.send();
            }
        } 
    }
</script>
<style>
    *{
        text-align: center;
    }
    .categoryDiv{
        position: relative;
        top:40px;
    }
    ul li{
        list-style: none;
        padding:10px 5px;
        text-align: center;
    }
    #cgSpan{
        position: relative;
        top:10px;
    }
    #selectedOption{
        text-align: left;
    }
</style>
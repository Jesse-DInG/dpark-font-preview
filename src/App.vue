<template>
  <div id="app">
    <!--<img class="logo" src="./assets/logo.png">-->
    <div class="area search-block">
      <input v-el:input type="text" name="keyword" placeholder="在此输入您要订制的文字" class="search-input flex" maxlength="10"
             v-model="searchTxt" @keyup.enter="showImages(searchTxt)">
      <a class="flex search-btn" @click="showImages(searchTxt)">搜索</a>
    </div>

    <div class="area tip-block">
      <p>
        字体前面的数字代表几号字体
      </p>
      <p>请选择好字体后在订单中按以下格式进行留言备注
      </p>
      <br>
      <p class="tip2">
        手机型号+订制的文字+几号字体
      </p>
      </form>

      <div class="clear"></div>
    </div>
    <ul>
      <a class="preview-item wrap" v-for="item in showList" @click="showPhone(item.src)">
        <img :src="item.src">
        <span class="preview-title">{{item.index}}</span>
      </a>
    </ul>
    <div class="phone-preview" v-show="showFontSrc.length>0" transition="expand" @click="hidePhone">
      <div class="mask"></div>
      <div class="phone-block">
        <div class="phone" > </div>
        <img class="font-label" :src="showFontSrc">
      </div>
    </div>
    <div class="phone preload" v-if="isLoad" > </div>
  </div>
</template>

<script>
  import {getFontList,getFontImg,getFonttest} from './api'
  export default {
    ready(){

      var ctx = this;
      getFontList().then(function(res){
        if(res.ok) {
          ctx.fontList = res.data.fonts;
          ctx.showImages("dpark");
          ctx.$nextTick(()=>{
            ctx.isLoad = true;
          })
        }
      })
    },

    data(){
      return {
        showFontSrc: '',
        searchTxt: '',
        showList: [
        ],
        fontList:[],
        isLoad:false
      }
    },
    methods: {
      showImages(label){
        this.$els.input.blur();
        if (label.length > 0) {
          var list = [];
          for (var i = 0; i < this.fontList.length; i++) {
            list.push({
              name: '字体' + this.fontList[i],
              index: i + 1,
              src: '/ajax/fontimage.php?font=' + this.fontList[i] + '&text=' + label
            })
          }
          this.showList = list;
        }
        var ctx = this;
        getFonttest(this.fontList[0],label).then(function(res){
          ctx.test = res.data;
        });
      },
      showPhone(fontLabel){
        this.showFontSrc = fontLabel;
      },
      hidePhone(){
        this.showFontSrc = '';
      }
    },
    components: {}
  }
</script>

<style rel="stylesheet/scss" type="text/css">
  /*html {*/
  /*height: 100%;*/
  /*}*/
  html{
    width: 100%;
    max-width: 720px;
    margin: auto !important;
  }

  html, body {
    overflow-x: hidden;
  }

  #app {
    color: #2c3e50;
    font-family: Source Sans Pro, Helvetica, sans-serif;
    text-align: center;
    width: 100%;
    overflow-x: hidden;
  }

  .area {
    padding: 1rem;
    border-radius: .5rem;
    background-color: #FDC818;
  }

  .search-block {
    display: flex;
    flex-direction: row;
  }

  .search-input {
    flex: 1;
    padding: 0 1rem;
    line-height: 4rem;
  }

  .search-btn {
    border: 1px solid #D6A500;
    background: #F7DF92;
    padding: 0 2rem;
    line-height: 4rem;
    text-align: center;
  }

  .search-btn:active {
    background-color: #fef6de;
  }

  .flex {
    display: inline-block;
    font-size: 2rem;
  }

  .tip-block {
    text-align: left;
    p {
      font-size: 5rem;
    }
  }

  .tip-block p {
    font-size: 2rem;
    line-height: 1.2;
  }

  .tip2 {
    background-color: #000;
    color: #FFE500;
    padding: .5rem;
  }

  .preview-item {
    display: block;
    border: 2px solid #FFE500;
  }

  .wrap {
    height: 0;
    padding-bottom: 15%;
    position: relative;
    width: 100%;

  }

  .wrap img {
    position: absolute;
    left: 4rem;
    top: 0;
    /*width: 100%;*/
    height: 100%;

  }

  .preview-title {
    position: absolute;
    left: 0;
    top: 0;
    width: 3rem;
    line-height: 1.2;
    font-size: 2rem;
    border-bottom-right-radius: 5px;
    background: #FDC818;
  }

  .phone-preview {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }

  .mask {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #000;
    opacity: .7;
    z-index: -1;
  }


  .phone-block {
    height: 0;
    padding-bottom: 106%;
    position: relative;
    width: 50%;
    margin-left: 25%;
    margin-top: 16%;
  }

  .phone {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: url(assets/phone.png) no-repeat center center;
    background-size: contain;
    /*vertical-align: middle;*/

    /*margin-left: 25%;*/
  }

  .preload{
    position: fixed;
    width: 0;
    height: 0;
  }

  .font-label{
    position: absolute;
    height: 4rem;
    right: 2.5rem;
    bottom: 2rem;
  }
  /* 必需 */
  .expand-transition {
    transition: all .5s ease;
    /*opacity: 1;*/
  }
  /*{*/
    /*opacity: 1;*/
  /*}*/
  .expand-enter,.expand-leave{
    opacity: 0;
  }
  /* .expand-enter 定义进入的开始状态 */
  /* .expand-leave 定义离开的结束状态 */
  /*.expand-enter, .expand-leave {*/
    /*height: 0;*/
    /*padding: 0 10px;*/
    /*opacity: 0;*/
  /*}*/
</style>

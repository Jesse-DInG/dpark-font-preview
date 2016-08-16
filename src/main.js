import Vue from 'vue'
import App from './App'
import VueResource from 'vue-resource'

import './reset.css'

let w = Math.min(window.innerWidth,window.innerHeight);
if(w>720)w = 720;
document.querySelector('html').style.fontSize= w/40 + 'px'
Vue.use(VueResource);
/* eslint-disable no-new */
new Vue({
  el: 'body',
  components: { App }
})


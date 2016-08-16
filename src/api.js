/**
 * Created by JesseDing  on 16/8/15.
 */
import Vue from 'vue'

let root = '';

export var getFontList = ()=>{
  return Vue.http.get(root + '/ajax/fontlist.php');
}

export var getFontImg = (font,text) => {
  return Vue.http.get(root + '/ajax/fontimage.php',{font,text})
}
export var getFonttest = (font,text) => {
  return Vue.http.get(root + '/ajax/fonttest.php?font=' + font + '&text=' + text)
}

"use strict";
// $("p") byTagName
// $("#p") byId
function $(param) {
    let p = param.match(/(#?)(.+)/);
    if(p[1]){
        return document.getElementById(p[2]);

    }else{
        return document.getElementsByTagName(p[2]);
    }
}

$.each = function (o, callback) {
    Array.prototype.forEach.call(o, callback);
};

Array.prototype.shuffle = function () {
    if(this.length == 1) return this;
    for(var j,x,i = this.length; i; j = Math.floor(Math.random()*i),
        x = this[--i], this[i] = this[j], this[j] = x);
    return this;

};
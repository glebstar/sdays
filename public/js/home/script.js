!function(e){var t={};function o(n){if(t[n])return t[n].exports;var r=t[n]={i:n,l:!1,exports:{}};return e[n].call(r.exports,r,r.exports,o),r.l=!0,r.exports}o.m=e,o.c=t,o.d=function(e,t,n){o.o(e,t)||Object.defineProperty(e,t,{configurable:!1,enumerable:!0,get:n})},o.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return o.d(t,"a",t),t},o.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},o.p="",o(o.s=1)}({1:function(e,t,o){e.exports=o("Sbud")},Sbud:function(e,t){function o(e){$("#res").hide(),0==e?($("#res-info").html("Select city...").show(),$.removeCookie("city_id")):($.cookie("city_id",e,{expires:30}),$("#res-info").html("Loading...").show(),$.post("/sdays",{city_id:e,_token:csrf_token},function(e){$("#res-info").hide(),$("#res-his").html(e.his),$("#res-month").html(e.month),$("#res-curr").html(e.curr),$("#res").show()}))}$(document).ready(function(){var e=$.cookie("city_id");void 0!=e&&($("#sel-city").val(e),o(e)),$("#sel-city").change(function(){o($(this).val())})})}});
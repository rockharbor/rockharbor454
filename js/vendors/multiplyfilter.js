
// Manipulate each canvas element after it has replaced the original image
prepareMultiply1(function (canvas) { canvas.style.zIndex = "-1";});
// Hoisted function
function prepareMultiply1(callback) {
    var images = document.getElementsByClassName("elem1");
    for(var n=0,m=images.length;n<m;n++){var image=images[n],canvas=document.createElement("canvas"),context=canvas&&canvas.getContext("2d");if(context){var dummy=new Image;dummy.onload=function(){var a=canvas.width=dummy.width,e=canvas.height=dummy.height;context.fillStyle="#fff",context.fillRect(0,0,a,e),context.drawImage(image,0,0);for(var t=context.getImageData(0,0,a,e),n=t.data,m=0,c=n.length;m<c;m+=4){var i=m,o=m+1,g=m+2,r=m+3,s=n[i],d=n[o],l=n[g],v=Math.round(.21*s+.71*d+.08*l);n[i]=0,n[o]=0,n[g]=0,n[r]=255-v}context.putImageData(t,0,0),canvas.className=image.className,image.parentNode.insertBefore(canvas,image),image.parentNode.removeChild(image),"function"==typeof callback&&callback(canvas)},dummy.src=image.src}}
}

prepareMultiply2(function (canvas) { canvas.style.zIndex = "-1";});
// Hoisted function
function prepareMultiply2(callback) {
    var images = document.getElementsByClassName("elem2");
    for(var n=0,m=images.length;n<m;n++){var image=images[n],canvas=document.createElement("canvas"),context=canvas&&canvas.getContext("2d");if(context){var dummy=new Image;dummy.onload=function(){var a=canvas.width=dummy.width,e=canvas.height=dummy.height;context.fillStyle="#fff",context.fillRect(0,0,a,e),context.drawImage(image,0,0);for(var t=context.getImageData(0,0,a,e),n=t.data,m=0,c=n.length;m<c;m+=4){var i=m,o=m+1,g=m+2,r=m+3,s=n[i],d=n[o],l=n[g],v=Math.round(.21*s+.71*d+.08*l);n[i]=0,n[o]=0,n[g]=0,n[r]=255-v}context.putImageData(t,0,0),canvas.className=image.className,image.parentNode.insertBefore(canvas,image),image.parentNode.removeChild(image),"function"==typeof callback&&callback(canvas)},dummy.src=image.src}}
}

prepareMultiply3(function (canvas) { canvas.style.zIndex = "-1";});
// Hoisted function
function prepareMultiply3(callback) {
    var images = document.getElementsByClassName("elem3");
    for(var n=0,m=images.length;n<m;n++){var image=images[n],canvas=document.createElement("canvas"),context=canvas&&canvas.getContext("2d");if(context){var dummy=new Image;dummy.onload=function(){var a=canvas.width=dummy.width,e=canvas.height=dummy.height;context.fillStyle="#fff",context.fillRect(0,0,a,e),context.drawImage(image,0,0);for(var t=context.getImageData(0,0,a,e),n=t.data,m=0,c=n.length;m<c;m+=4){var i=m,o=m+1,g=m+2,r=m+3,s=n[i],d=n[o],l=n[g],v=Math.round(.21*s+.71*d+.08*l);n[i]=0,n[o]=0,n[g]=0,n[r]=255-v}context.putImageData(t,0,0),canvas.className=image.className,image.parentNode.insertBefore(canvas,image),image.parentNode.removeChild(image),"function"==typeof callback&&callback(canvas)},dummy.src=image.src}}
}

prepareMultiply4(function (canvas) { canvas.style.zIndex = "-1";});
// Hoisted function
function prepareMultiply4(callback) {
    var images = document.getElementsByClassName("elem4");
    for(var n=0,m=images.length;n<m;n++){var image=images[n],canvas=document.createElement("canvas"),context=canvas&&canvas.getContext("2d");if(context){var dummy=new Image;dummy.onload=function(){var a=canvas.width=dummy.width,e=canvas.height=dummy.height;context.fillStyle="#fff",context.fillRect(0,0,a,e),context.drawImage(image,0,0);for(var t=context.getImageData(0,0,a,e),n=t.data,m=0,c=n.length;m<c;m+=4){var i=m,o=m+1,g=m+2,r=m+3,s=n[i],d=n[o],l=n[g],v=Math.round(.21*s+.71*d+.08*l);n[i]=0,n[o]=0,n[g]=0,n[r]=255-v}context.putImageData(t,0,0),canvas.className=image.className,image.parentNode.insertBefore(canvas,image),image.parentNode.removeChild(image),"function"==typeof callback&&callback(canvas)},dummy.src=image.src}}
}

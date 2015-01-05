$(function(){
	if($(".i2_cagd").length>0){
		ymonusecag();
	}
})
function login(){
	$('#formg').submit();
}
function register(){
	$('#formg2').submit();
}
function ymonusecag(){
    var cagam=$(".cagam");
    var i2_cagd=$(".i2_cagd");
    var itar=0;
    cagam[0].onclick=function(){
        if(itar==0){
        cagam.addClass('currr');
        i2_cagd[0].style.display='block';
            itar=1;
        }else{
            cagam.removeClass('currr');
            i2_cagd[0].style.display='none';
            itar=0;
        }
    }
}
// 信息提示
var Dialog = {

    show: function(msg){
        var auto_hide = arguments[1] ? arguments[1] : false;
        var html = '';
        var dialog = document.getElementById('id-dialog');
        if( !dialog ){

            height = !auto_hide? 120: 75;
            dialog = document.createElement('div');
            dialog.id = 'id-dialog';
            /*dialog.style = 'position:absolute; top:-999px; left:-999px; width:250px; height:100px;'+
             'background-color:#FFF; border-width: 2px; border-style: solid; border-color: #CCC;'+
             'text-align:center; vertical-align:middle; display:none;';*/
            dialog.style.position = 'absolute';
            dialog.style.top = '-999px';
            dialog.style.left = '-999px';
            dialog.style.width = '250px';
            dialog.style.height = height + 'px';
            dialog.style.backgroundColor = '#FFFFFF';
            dialog.style.border = '2px solid #cccccc';

            dialog.style.verticalAlign = 'middle';
            dialog.style.display = 'block';
            dialog.style.zIndex = 999999;

            document.getElementsByTagName('body')[0].appendChild(dialog);
            var dialogbk=document.createElement('div');
            dialogbk.id='id-dialogbk';
            dialogbk.style.position='fixed';
            dialogbk.style.zIndex=99998;
            dialogbk.style.width='100%';
            dialogbk.style.height='100%';
            dialogbk.style.backgroundColor='#000';
            dialogbk.style.opacity=0.5;
            dialogbk.style.top='0px'
            document.getElementsByTagName('body')[0].appendChild(dialogbk);
        }
        html = '<div style="position:absolute; width:250px; text-align: center; height:'+ 100 +'px; line-height:25px; left:0px; top:0px;' +
            'font-weight:bold;margin-top:20px; ' +
            'font-size:14px;">'+"<i></i><span>" + msg + '</span></div>';
        if( !auto_hide ) html += '<em id="id-dialog_sure">' +
            '</em>';
        dialog.innerHTML = html;
        dialog.style.display = 'block';
        this.setPos('id-dialog');
        //

        if( !auto_hide ){
            document.getElementById('id-dialog_sure').onclick = function(){Dialog.hide()};
            document.getElementById('id-dialogbk').onclick = function(){Dialog.hide()};
        } else {
            setTimeout(function(){Dialog.hide();}, 2000);
        }
    },

    hide: function (){
        var dialog = document.getElementById('id-dialog');
        if( dialog ) dialog.style.display = 'none';
        var dialogbk = document.getElementById('id-dialogbk');
        if( dialogbk ) dialogbk.style.display = 'none';
    },

    setPos : function (displayid){
        var div = document.getElementById(displayid);

        var screen_h = parseInt(window.innerHeight? window.innerHeight: document.documentElement.offsetHeight);
        var screen_w = parseInt(window.innerWidth? window.innerWidth: document.documentElement.offsetWidth);
        var top = ( screen_h - div.clientHeight ) / 2;
        var left = ( screen_w - div.clientWidth ) / 2;
        var posX, posY;

        //
        if (window.innerHeight) {
            posX = window.pageXOffset;
            posY = window.pageYOffset;
        } else if (document.documentElement && document.documentElement.scrollTop) {
            posX = document.documentElement.scrollLeft;
            posY = document.documentElement.scrollTop;
        } else if (document.body) {
            posX = document.body.scrollLeft;
            posY = document.body.scrollTop;
        }
        top = posY + top;

        //
        div.style.top = "30%";
        div.style.left = "15%";

        //
        div.style.display = 'block';
    },

    setPos2 : function(displayid){
        var oShow = document.getElementById(displayid);
        oShow.style.display = 'block';

        var iWidth = document.documentElement.clientWidth;
        var iHeight = document.documentElement.clientHeight;
        var scrollHeight = document.documentElement.scrollTop;

        var oWidth = oShow.offsetWidth || oShow.clientWidth;
        var oHeight = oShow.offsetHeight || oShow.clientHeight;

        oShow.style.left = (iWidth-oWidth)/2 + "px";
        oShow.style.top = (iHeight-oHeight)/2 + scrollHeight + "px";

    }
}
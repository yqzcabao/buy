//后端设置图片
function setsite_pic1(json){
	var filename=$("#fileupload1").attr("name");
	$("input[name='screenad[1][pic]']").val(json[filename].pic);
}
function setsite_pic2(json){
	var filename=$("#fileupload2").attr("name");
	$("input[name='screenad[2][pic]']").val(json[filename].pic);
}
function setsite_pic3(json){
	var filename=$("#fileupload3").attr("name");
	$("input[name='screenad[3][pic]']").val(json[filename].pic);
}
function setsite_pic4(json){
	var filename=$("#fileupload4").attr("name");
	$("input[name='screenad[4][pic]']").val(json[filename].pic);
}
function setsite_pic5(json){
	var filename=$("#fileupload5").attr("name");
	$("input[name='screenad[5][pic]']").val(json[filename].pic);
}
function setsite_pic6(json){
	var filename=$("#fileupload6").attr("name");
	$("input[name='screenad[6][pic]']").val(json[filename].pic);
}
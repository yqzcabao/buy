<script charset="utf-8" src="../static/kindeditor/kindeditor.js"></script>
<script type="text/javascript">
$(function(){
	if($("#content").length>0){
		KindEditor.options.filterMode = false;
    	editor = KindEditor.create('#content');
	}
})
</script>
<form method="post" action="?mod=<?=MODNAME;?>&ac=<?=ACTNAME;?>&op=set">
  	<!--//网站基本信息-->
    <table class="table-font">
    	<tbody>
    	<tr>
            <th>未晒单是否可申请</th>
            <td>
            	<?=showRadio('exc[exchange_showinfo]',array('1'=>'可申请','0'=>'不可申请'),$_webset['exchange_showinfo'],'exchange_showinfo');?>
            </td>
        </tr>
    	<tr>
            <th class="w120" style="vertical-align: top;">兑换规则：</th>
            <td>
            	<textarea style="width:700px;height:400px" id="content" name="webset[exchange_rule]"><?=$_webset['exchange_rule'];?></textarea>
            </td>
        </tr>
    </tbody></table>          
    <div class="box-footer">
        <div class="box-footer-inner">
        	<input type="hidden" name="formhash" value="<?=formhash();?>">
        	<input type="submit" name="excset" value="保存更改">
        </div>
    </div>
 </form>
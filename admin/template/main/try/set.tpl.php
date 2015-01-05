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
            	<?=showRadio('try[try_showinfo]',array('1'=>'可申请','0'=>'不可申请'),$_webset['try_showinfo'],'try_showinfo');?>
            </td>
        </tr>
    	<tr>
            <th class="w120" style="vertical-align: top;">试用规则：</th>
            <td>
            	<textarea style="width:700px;height:400px" id="content" name="try[try_rule]"><?=$_webset['try_rule'];?></textarea>
            </td>
        </tr>
    </tbody></table>
    <div class="box-footer">
        <div class="box-footer-inner">
        	<input type="hidden" name="formhash" value="<?=formhash();?>">
        	<input type="submit" name="tryset" value="保存更改">
        </div>
    </div>
 </form>
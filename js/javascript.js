$(function(){
	$(".link_button").each(function(){
		$(this).hover(function(){
			$(this).addClass("link_button_red");
			$(this).removeClass("link_button");
		},function(){
			$(this).addClass("link_button");
			$(this).removeClass("link_button_red");
		});
	});
	$(".link_button_2").each(function(){
		$(this).hover(function(){
			$(this).addClass("link_button_2_red");
			$(this).removeClass("link_button_2");
		},function(){
			$(this).addClass("link_button_2");
			$(this).removeClass("link_button_2_red");
		});
	});
	$(".rightmenunochecked").each(function(){
		$(this).hover(function(){
			$(this).addClass("rightmenuchecked");
			$(this).removeClass("rightmenunochecked");
		},function(){
			$(this).addClass("rightmenunochecked");
			$(this).removeClass("rightmenuchecked");
		});
	});
	$(".a5").each(function(){
		$(this).mouseover(function(){
			$(this).find("div").css("display","block");
		}).mouseout(function(){
			$(this).find("div").css("display","none");
		});
	});
	func1=function(){
		$(this).mouseover(function(){
			$(this).next("tr").find("div").css("display","block");
		}).mouseout(function(){
			$(this).next("tr").find("div").css("display","none");
		});
	};
	$(".a6").each(func1);
	$(".a7").each(func1);
	$("input[name=opids]").each(function(){
		$(this).change(function(){
			if("checked"==$(this).attr("checked")){
				$("input[type=checkbox]").each(function(){
					$(this).attr("checked",true);
				});
			}else{
				$("input[type=checkbox]").each(function(){
					$(this).attr("checked",false);
				});
			}
		});
	});
	$("select[name=method]").each(function(){
		$(this).change(function(){
			val=$(this).val();
			$("select[name=method]").each(function(){
				$(this).val(val);
			});
		});
	});
	$("input[name=tags]").focus(function(){
		if($.trim($(this).val())=="在此输入标签，多个标签用英语逗号（,）分割"){
			$(this).val("");
		}
	}).focusout(function(){
		if($.trim($(this).val())==""){
			$(this).val("在此输入标签，多个标签用英语逗号（,）分割");
		}
	});
});
function choose(base_url){
	tag=$("select[name=tag]").val();
	if($("select[name=tag]").val()==undefined){
		tag="_";
	}
	url=base_url+tag+"/"+$("select[name=date]").val()+"/0";
	$("#get").attr("href",url);
}
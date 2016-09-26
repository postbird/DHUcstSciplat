(function(a){
	a.fn.jdSlide=function(k){
		var p=a.extend({
			width:null,height:null,pics:[],index:0,type:"num",current:"curr",delay1:100,delay2:5000
		}
		,k||{});
		var i=this;
		var g,f,d,h=0,e=true,b=true;
		var n=p.pics.length;
		var o=function(){
			var q="<ul style='position:absolute;top:0;left:0;'><li><a href='"+p.pics[0].href+"' target='_blank'><img src='"+p.pics[0].src+"' width='"+p.width+"' height='"+p.height+"' /></a></li></ul>";
			i.css({
				position:"relative"
			}).html(q);
			i.find("ul").css({
				width:n*p.width+"px",height:p.height+"px"
			});
			a(function(){
				c()
			})
		};
		o();
		var j=function(){
			var s=[];
			s.push("<div>");
			var r;
			var q;
			for(var t=0;t<n;t++){
				r=(t==p.index)?p.current:"";
				switch(p.type){
					case"num":q=t+1;
					break;
					case"string":q=p.pics[t].alt;
					break;
					case"image":q="<img src='"+p.pics[t].breviary+"' />";
					default:break
				}
				s.push("<span class='");
				s.push(r);
				s.push("'><a href='");
				s.push(p.pics[t].href);
				s.push("' target='_blank'>");
				s.push(q);
				s.push("</a></span>")
			}
			s.push("</div>");
			i.append(s.join(""));
			var x=[];
			x.push("<div id='goback' class='o-control'><a class='control'></a></div><div id='forward' class='o-control'><a class='control'></a></div>");
			i.append(x.join(""));
			i.find("#goback").bind("mouseover",function(){
				b=false;
				clearTimeout(g);
				clearTimeout(d)
			}).bind("click",function(){
				var u=p.index-1;
				if(u<0){
					u=t-1
				};
				l(u)
			}).bind("mouseleave",function(){
				b=true;
			});
			i.find("#forward").bind("mouseover",function(){
				b=false;
				clearTimeout(g);
				clearTimeout(d)
			}).bind("click",function(){
				var u=p.index+1;
				l(u)
			}).bind("mouseleave",function(){
				b=true;
			});
			i.find("span").bind("mouseover",function(){
				b=false;
				clearTimeout(g);
				clearTimeout(d);
				var u=i.find("span").index(this);
				if(p.index==u){
					return
				}
				else{
					d=setInterval(function(){
						if(e){
							l(u)
						}
					}
					,p.delay1)
				}
			}).bind("mouseleave",function(){
				b=true;
				clearTimeout(g);
				clearTimeout(d);
				g=setTimeout(function(){
					l(p.index+1,true)
				}
				,p.delay2)
			});
			i.bind("mouseover",function(){
				$("#slide .o-control").show()
			}).bind("mouseleave",function(){
				$("#slide .o-control").hide()
			})
		};
		var l=function(r,q){
			if(r==n){
				r=0
			}
			f=setTimeout(function(){
				i.find("span").eq(p.index).removeClass(p.current);
				i.find("span").eq(r).addClass(p.current);
				m(r,q)
			}
			,20)
		};
		var m=function(u,q){
			var s=parseInt(h);
			var v=Math.abs(s+p.index*p.width);
			var t=Math.abs(u-p.index)*p.width;
			var r=Math.ceil((t-v)/4);
			if(v==t){
				clearTimeout(f);
				if(q){
					p.index++;
					if(p.index==n){
						p.index=0
					}
				}
				else{
					p.index=u
				}
				e=true;
				if(e&&b){
					clearTimeout(g);
					g=setTimeout(function(){
						l(p.index+1,true)
					}
					,p.delay2)
				}
			}
			else{
				if(p.index<u){
					h=s-r;
					i.find("ul").css({
						left:h+"px"
					})
				}
				else{
					h=s+r;
					i.find("ul").css({
						left:h+"px"
					})
				}
				e=false;
				f=setTimeout(function(){
					m(u,q)
				}
				,20)
			}
		};
		var c=function(){
			var q=[];
			for(var r=1;r<n;r++){
				q.push("<li><a href='");
				q.push(p.pics[r].href);
				q.push("' target='_blank'><img src='");
				q.push(p.pics[r].src);
				q.push("' width='");
				q.push(p.width);
				q.push("' height='");
				q.push(p.height);
				q.push("' /></a></li>")
			}
			i.find("ul").append(q.join(""));
			g=setTimeout(function(){
				l(p.index+1,true)
			}


			,p.delay2);
			if(p.type){
				j()
			}
		}
	}
	//Download by http://www.codefans.net
})(jQuery);
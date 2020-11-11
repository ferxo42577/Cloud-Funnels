var request=new ajaxRequest();
var qfnl_integrations=new Vue({
    el:"#qfnlintegrations",
    mounted:function(){
        if(this.show=="setup")
        {
            this.init();
        }
    },
    data: {
        idcont:0,
        id:0,
        title:'',
        type:'',
        data:'',
        position:'footer',
        open:0,
        err:"",
        show:"table",
        code:true,
        reload:0,
        do:"insert",
        integration_types:{tawkdotto:'tawk.to',messenger:'Messenger',skype:'Skype',ganalytic:'Google Analytic',fpixel:'Facebook Pixel',custom:'Custom'},
    },
    methods:{
    /*w:function(txt,arr=[]){
		w(txt,arr);
	},*/
	t:function(txt,arr=[]){
		return t(txt,arr);
	},
     searchAutoresponders:function(e){
         //alert("test");
         var thisvue=this;
         var search=e.target.value;
         var ob=new OnPageSearch(search,"#keywordsearchresult");
         ob.url=window.location.href;
         ob.minsearch_len=0;
         ob.cb=function(data){
             //console.log(data);
             var Elem_ob=Vue.extend({
                 template:"<tbody id='keywordsearchresult'>"+data+"</tbody>",
                 methods:{
                    showDiv:function(a,b){thisvue.showDiv(a,b);},
                 }
             });
             var elem=new Elem_ob().$mount();
             document.getElementById("keywordsearchtable").replaceChild(elem.$el,document.getElementById("keywordsearchresult"));
         };
         ob.search();
     },
     init:function(){ var id_doc=document.getElementById("inididintegration");
     if(id_doc.value>0)
     {
         this.id=id_doc.value;
         //this.getSettings();
     }
     var replaceid=this.id;
     var thiss=this;
     //alert(thiss.id);
     var new_id=Vue.extend({
         template: '<span><input type="hidden" id="intid" value="0" v-model="id">{{init()}}</span>',
         mounted:function(){},
         data:function(){return {id: replaceid.id};},
         methods:{
             init:function(){
                 this.id=thiss.id;
             },
         },
     });
     var new_id_elem=new new_id().$mount();
     //console.log(new_id_elem);
     this.$el.replaceChild(new_id_elem.$el,id_doc);
     this.idcont=new_id_elem.$el;},
     showDiv:function(show,id=0)
     {
         this.show=show;
         var searchdoc=document.getElementById("searchdivv");
         var designdiv1=document.getElementById("hidecard1");
         var designdiv2=document.getElementById("hidecard2");
         if(show=="table"){
             searchdoc.style.display="block";
             designdiv1.classList.add("card","pb-2","br-rounded");
             designdiv2.classList.add("card-body","pb-2");
            }else{
                searchdoc.style.display="none";
                designdiv1.classList.remove("card","pb-2","br-rounded");
                designdiv2.classList.remove("card-body","pb-2");
            }
         if(show=="table" && this.reload==1)
         {
             if(this.do=="insert")
             {
                window.location="index.php?page=integrations";
             }
             else
             {
                 window.location.reload();
             }
         }
         else
         {
             if(id>0)
             {
                 this.id=id;
                 this.getSettings();
                 this.popupOpen(this.type);
             }
         }   
     },
     toggleCode:function(){
         this.code=(this.code)? false:true;
     },
      popupOpen:function(type,position='footer',code=true){
          this.code=code;
          var thisvue=this;
          if(this.open==1)
          {
              this.popupClose();
              this.popupOpen(type);
          }
          else
          {
          this.open=1;
          this.type=type;
          this.position=position;
          }
          doEscapePopup(function(){if(thisvue.open){thisvue.popupClose();}});
      },
      popupClose:function(){
          this.id=0;
          this.title="";
          this.type="";
          this.data="";
          this.position="footer";
          this.open=0;
          this.err="";
      },
      popUp:function($type="Add"){
          var div=document.createElement("div");
          div.classList.add('row');
          return "";
      },
      saveSettings:function(e){
          this.err="<font color='green'>"+this.t("Saving...")+"</font>";
          e.target.disabled=true;
          var thiss=this;

            this.do=(this.id>0)? "update":"insert";

          if(this.title.length>0 && this.data.length>0)
          {
          var req_data={"saveintegration":this.id,"title":this.title,"data":this.data,"position":this.position,"type":this.type};
          request.postRequestCb('req.php',req_data,function(data){
              thiss.reload=1;
              e.target.disabled=false;
              if(data.trim()=="0" || isNaN(data.trim()))
              {
                  console.log(data.trim());
                  thiss.err="<font color='#800033'>"+this.t("Unable To Save Integration.")+"</font>";
              }
              else
              {
              e.target.disabled=false;    
              thiss.id=data.trim();
              thiss.err="<font color='green'>"+this.t("Successfully Saved")+"</font>";
              }
          });
            }
            else
            {
                e.target.disabled=false;
                this.err="<font color='#800033'>"+this.t("Please Provide All Required Data")+"</font>";
            }
      },
      getSettings:function(){
          var thiss=this;
          var req_data={"gateintegration":this.id};
          this.err="<font color='green'>Loading...</font>";
          request.postRequestCb('req.php',req_data,function(data){
              //console.log(data);
              data=data.trim();
              if(data=="0")
              {
                  thiss.err="<font color='#800033'>"+this.t("Unable To Load Integration")+"</font>";
              }
              else
              {
                  try
                  {
                    var json_ob=JSON.parse(data);
                    thiss.title=json_ob.title;
                    thiss.type=json_ob.type;
                    thiss.data=json_ob.data;
                    thiss.position=json_ob.position;
                    thiss.err="";
                    modifytitle(thiss.title,'Integrations');
                    if(thiss.type=="messenger" || thiss.type=="skype")
                    {
                        thiss.code=false;
                        if(thiss.data.indexOf("/script")>0)
                        {
                            thiss.code=true;
                        }
                    }

                  }
                  catch(errr)
                  {
                      thiss.err="Unable To Load Integration";
                      console.log(errr.message);
                      console.log(data);
                  }
              }

          });
      },
    },
});

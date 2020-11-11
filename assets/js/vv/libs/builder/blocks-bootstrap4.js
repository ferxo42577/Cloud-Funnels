/*
Copyright 2017 Ziadin Givan

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

   http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

https://github.com/givanz/Vvvebjs
*/

Vvveb.BlocksGroup['Bootstrap 4 Snippets'] =
["bootstrap4/signin-split", "bootstrap4/slider-header", "bootstrap4/image-gallery", "bootstrap4/video-header", "bootstrap4/about-team", "bootstrap4/portfolio-one-column", "bootstrap4/portfolio-two-column", "bootstrap4/portfolio-three-column", "bootstrap4/portfolio-four-column","bootstrap4/testimonial-one-column","bootstrap4/testimonial-two-column","bootstrap4/footer-lower-social-icon","bootstrap4/footer-upper-social-icon","bootstrap4/modern-testimonial-one-column","bootstrap4/team-two-column","bootstrap4/team-three-column","bootstrap4/services-three-column","bootstrap4/services-two-column","bootstrap4/about-with-side-image","bootstrap4/about-with-header-image","bootstrap4/navbar-with-address","bootstrap4/navbar-with-address-social-icon","bootstrap4/contact-us","bootstrap4/contact-us-with-map","bootstrap4/features-three-column","bootstrap4/features-with-image","bootstrap4/faqs-two-column","bootstrap4/faqs-one-column","bootstrap4/archives-four-column","bootstrap4/subscribe-one","bootstrap4/subscribe-two","bootstrap4/stats-three-column","bootstrap4/stats-three-column-timer","bootstrap4/hero-block"];

Vvveb.Blocks.add("bootstrap4/hero-block", {
  name: t("Modren Hero block"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/hero-block.png",
  html:`
<div class="hero-column pb-5" >
  <div class="container">
        <div class="text-white mt-5 pb-5 m-sm-3 m-md-4 pt-1 mb-md-5 mb-0">
          <h1 class="text-center font-weight-bolder ">Hello I am a Photographer</h1>
          <div class="w-sm-75 w-md-50 mx-auto text-center">
            <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          </p>
          </div>
        </div>
        <div class="row mt-md-3 mt-0  justify-content-center">
            <div class="col-lg-4 text-white">
              <a href="#">
                <div class="column text-white">
                  <div class="text-center  p-2">
                    <i class='fas fa-expand p-1'></i>  
                      <h4 style="font-family: sans-serif;">WildLife PhotoGraphy</h4>
                  </div>
                  <div class="text-center">
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                      </p>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-4">
              <a href="#">
                <div class="column text-white">
                  <div class="text-center p-2">
                      <i class="fas fa-gem  p-1"></i>
                      <h4 style="font-family: sans-serif;">Professional PhotoGraphy</h4>
                  </div>
                  <div class="text-center">
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                      </p>
                  </div>
                </div> 
              </a>
            </div>
            <div class="col-lg-4">
             <a href="#">
             <div class="column text-white">
                <div class="text-center text-white  p-2">
                   <i class="fas fa-film  p-1" ></i>
                    <h4 style="font-family: sans-serif;">Wedding Photography</h4>
                </div>
                <div class="text-center">
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    </p>
                </div>
              </div>
            </a>
            </div>
        </div>
    </div>
  <style type="text/css">
.hero-column{ 
  background-image: url('https://source.unsplash.com/LmkaYtMpNS8/1400x1000');
  background-position: center;
  background-size: cover;
  width: 100%;
  height: 100%  ;
  position: relative;
  background-repeat: no-repeat;
  display: inline-table;
}

.hero-column .row{
  color: #ffffff;
}
.hero-column .container h1{
  font-size: 2.5em;
}
.hero-column .container p{
  color: #818181;
}
.hero-column .row p{
  font-size: 1em;
  transition: 0.5s;
}
.hero-column .row .column{
  color: #818181;
}
.hero-column .row  a{
  transition: 0.5s;
}
.hero-column .row  a:hover{
  text-decoration: none;
}
.hero-column .row  a:hover i{
  transform: scale(1.2);
}
.hero-column .row  .column h4,
.hero-column .row  .column i,
.hero-column .row  .column p{
  transition: 0.7s;
}
.hero-column .row  a:hover .column p{
  color: #ffffff;

}
.hero-column .row  a:hover .column h4{
  transform: scale(1.2);
}
.hero-column .row .column .fas{
  color: #f1f1f2;
  font-size: 2em;
}
</style>
</div>
`});

Vvveb.Blocks.add("bootstrap4/stats-three-column-timer", {
  name: t("Stats three column with CountDown Time"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/stats2.png",
  html:`
<div class="stats-with-timer p-1 p-md-5" >
  <div class="container">
         <div class="text-center">
            <div class="main-heading">
              Our Power in Numbers
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
         </div>
         <div class="row hide">
             
          <div class="col-sm-3 text-center ">
              <div class="p-3 border border-dark my-1 my-sm-0">
                <div class="numbers days" >
                  234
                </div>
                Days
              </div>
          </div>
          <div class="col-sm-3 text-center my-1 my-sm-0" >
            <div class="p-3 border border-dark">
                <div class="numbers hours">
                  05
                </div>
                Hours
            </div>   
          </div>
          <div class="col-sm-3 text-center  my-1 my-sm-0">
            <div class="p-3 border border-dark">
              <div class="numbers minutes">
                  12
              </div>
                Minutes
            </div>   
          </div>
          <div class="col-sm-3 text-center  my-1 my-sm-0">
              <div class="p-3 border border-dark">
                <div class="numbers seconds">
                 44 
                </div>
                Seconds
              </div>
           </div>
        </div>
        <div class="row">
          <div class="col-12 text-center expired">
            
          </div>
        </div>
  </div>
<style type="text/css">
.stats-with-timer{
  background-color: #000000;
  color: #ffffff;

}
.stats-with-timer .main-heading{
  font-size: 3em;

}
.stats-with-timer .numbers{
  font-size: 3em;
  padding-bottom: 0;

  color: #818181;

}
</style>
<script type="text/javascript">
$(function(){
function statsWithTimer(){

    var countDownDate=new Date("Jul 7, 2021 16:40:10").getTime();
  var x=setInterval(function(){
    var now=new Date().getTime();
    var distance=countDownDate-now;
    var days=Math.floor( distance/(1000*60*60*24) );
    var hours=Math.floor( ( distance%(1000*60*60*24)) / (1000*60*60) );
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60) );
    var seconds=Math.floor((distance % (1000*60))/(1000));
    $(".stats-with-timer .days").text(days);
    $(".stats-with-timer .hours").text(hours);
    $(".stats-with-timer .minutes").text(minutes);
    $(".stats-with-timer .seconds").text(seconds);


    if(distance < 0 ){
      clearInterval(x);
      $(".stats-with-timer .hide").hide();
      $(".stats-with-timer .expired").text("EXPIRED");
    }
  },1000);


}
statsWithTimer();
});
</script>
</div>
`});

Vvveb.Blocks.add("bootstrap4/stats-three-column", {
  name: t("Stats three column"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/stats1.png",
  html:`
<div class="stats-three-column-chart p-1 p-md-5" >
  <div class="container">
      <div class="main-heading text-center p-2">
          <div class="font-weight-bolder">Creative Charts</div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="text-center border border-dark p-2 p-md-5 m-1 m-sm-0">
              <div class="percentage percentageOne">0%</div>
              <h5 style="font-family: monospace;">Design</h5>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="text-center border border-dark p-2 p-md-5  m-1 m-sm-0">
              <div class="percentage percentageTwo">0%</div>
              <h5 style="font-family: monospace;">Developing</h5>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="text-center border border-dark p-2 p-md-5  m-1 m-sm-0">
              <div class="percentage percentageThree">0%</div>
              <h5 style="font-family: monospace;">Marketing</h5>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
          </div>
        </div>
      </div>
  </div>
<style type="text/css">
.stats-three-column-chart{
  background-color: #000000;
  color: #ffffff;

}
.stats-three-column-chart .main-heading{
  font-size: 3em;

}
.stats-three-column-chart .percentage{
  font-size: 3.5em;

  color: #818181;

}
</style>
<script type="text/javascript">
function statsThree(){
  $(function(){
    $(window).on("load",function(){
    // var percentage=$(".percentage");
    var percentageNumberOne=0;
    var designIncIntOne=setInterval(design_increase_one,5);
    function design_increase_one(){
      if(percentageNumberOne==70){
        clearInterval(designIncIntOne);
      }else{
        percentageNumberOne++;
        $(".percentageOne").text(percentageNumberOne+"%");
      }
    }
    var percentageNumberTwo=0;
    var designIncIntTwo=setInterval(design_increase_two,5);
    function design_increase_two(){
      if(percentageNumberTwo==80){
        clearInterval(designIncIntTwo);
      }else{
        percentageNumberTwo++;
        $(".percentageTwo").text(percentageNumberTwo+"%");
      }
    }
    var percentageNumberThree=0;
    var designIncIntthree=setInterval(design_increase_three,5);
    function design_increase_three(){
      if(percentageNumberThree==86){
        clearInterval(designIncIntthree);
      }else{
        percentageNumberThree++;
        $(".percentageThree").text(percentageNumberThree+"%");
      }
    }
  });
  });
}
statsThree();
</script>
</div>
`
});
Vvveb.Blocks.add("bootstrap4/subscribe-two", {
  name: t("Join us"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/subscribe2.png",
  html:`
<div class="subscribe-two  py-3" >
  <div class="container py-3 py-md-5">
      <div class="row">
        <div class="col-lg-4 pt-0">
          <div>
            <h1 class="font-weight-boler mt-0 pt-0 text-center text-lg-left" style="font-size: 3em;font-family: sans-serif;">Join Our Team</h1>
          </div>
        </div>
        <div class="col-lg-8 pt-2">
            <form action="" method="post">
              <div class="row container mx-auto  pb-5 pt-2">
                <div class="col-sm-9 p-0 m-0 column ">
                  <input type="email" class="form-control border border-sm-right-0" style="width: 100%" name="email" placeholder="Enter Email">
                </div>
                <div class="col-sm-3 p-0 m-0 column">
                  <button type="submit" name="submit" class="btn btn-light border font-weight-boler">Subscribe</button>
                </div>
              </div>
            </form>
        </div>
      </div>
  </div>
<style type="text/css">
.subscribe-two{
  background-color: #000000;
  color: #f1f1f1;
}
.subscribe-two input{
  background-color: #000000;
  color: #ffffff;
}
.subscribe-two input:active,
.subscribe-two input:focus{
  background-color: #000000;
  color: #ffffff;
  border-radius: 0;
}
.subscribe-two button{
  background-color: #ffffff;
  color: #000000;
  width: 100%;
  border-radius: 0;
}
@media screen and (max-width: 566px){
  .subscribe-two .row button{
    width: 100px;
    margin: 4px;
    float: right;
  }
}
</style>  
</div>
`
});
Vvveb.Blocks.add("bootstrap4/subscribe-one", {
  name: t("Subscribe with us"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/subscribe1.png",
  html:`
<div class="subscribe-one  py-3" >
    <div class="container text-center mx-auto">
      <div class="main-heading font-weight-boler mt-5 " style="font-family: sans-serif;">
          <h1>Subscribe to Our Newsletter</h1>
      </div>
      <form action="" method="post">
        <div class="row container mx-auto  pb-5 pt-2">
          <div class="col-sm-9 p-0 m-0 column ">
            <input type="email" class="form-control border border-sm-right-0" style="width: 100%" name="email" placeholder="Enter Email">
          </div>
          <div class="col-sm-3 p-0 m-0 column">
            <button type="submit" name="submit" class="btn btn-light border font-weight-boler">Subscribe</button>
          </div>
        </div>
      </form>
    </div>
<style type="text/css">
.subscribe-one{
  background-color: #000000;
  color: #f1f1f1;
}
.subscribe-one input{
  background-color: #000000;
  color: #ffffff;
}
.subscribe-one input:active,
.subscribe-one input:focus{
  background-color: #000000;
  color: #ffffff;
}
 .subscribe-one .row .column button{
    width: 100%;
    border-radius: 0;
}
 .subscribe-one .row .column input{
    width: 100%;
    border-radius: 0;
}
.subscribe-one .row{
    width: 50%;
  }
@media screen and (max-width: 766px){
  .subscribe-one .row{
    width: 100%;
  }
}
@media screen and (max-width: 566px){
  .subscribe-one .row .column button{
    width: 100px;
    margin: 4px;
    float: right;
    border:2px solid #000000;
  }
}
</style>
</div>
`
});

Vvveb.Blocks.add("bootstrap4/faqs-one-column", {
  name: t("Frequently Asked Questions"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/faqs2.png",
  html:`
<div class="faq-one-column" >
    <div class="container-sm text-white p-lg-4">
        <div class="main-heading text-center p-sm-3 m-sm-3 pb-2">
            <h1 class="text-center font-weight-bolder">FAQ</h1>
        </div>
        <div class="w-xl-50 w-md-75 w-100 p-sm-3 p-0 pb-2">
            <div class="card bg-dark mb-4">
                <div class="card-header">
                  <h6 class="font-weight-bolder caret-down-c">
                    <a href="#faqOne" class="card-link d-flex justify-content-between align-item-center" data-toggle="collapse"> CAN I EDIT THIS FILE ?
                      <i class="fas fa-caret-down"></i>
                    </a>
                  </h6>
                </div>
                <div id="faqOne" class="collapse fade" >
                  <div class="card-body">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                  </div>
                </div>
              </div>
              <div class="card bg-dark mb-4">
                <div class="card-header">
                  <h6 class="font-weight-bolder caret-down-c">
                    <a href="#faqTwo" class="card-link d-flex justify-content-between align-item-center" data-toggle="collapse"> IS IT LAYRED ?
                      <i class="fas fa-caret-down"></i>
                    </a>
                  </h6>
                </div>
                <div id="faqTwo" class="collapse fade" >
                  <div class="card-body">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                  </div>
                </div>
              </div>
              <div class="card bg-dark mb-4">
                <div class="card-header">
                  <h6 class="font-weight-bolder caret-down-c">
                    <a href="#faqThree" class="card-link d-flex justify-content-between align-item-center" data-toggle="collapse"> HOW CAN I EDI THIS MASKS ?
                      <i class="fas fa-caret-down"></i>
                    </a>
                  </h6>
                </div>
                <div id="faqThree" class="collapse fade" >
                  <div class="card-body">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                  </div>
                </div>
              </div>
              <div class="card bg-dark mb-4">
                <div class="card-header">
                  <h6 class="font-weight-bolder caret-down-c">
                    <a href="#faqFour" class="card-link d-flex justify-content-between align-item-center" data-toggle="collapse"> WHAT DO I NEED TO OPEN THIS FILE ?
                      <i class="fas fa-caret-down"></i>
                    </a>
                  </h6>
                </div>
                <div id="faqFour" class="collapse fade" >
                  <div class="card-body">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                  </div>
                </div>
              </div>
              <div class="card bg-dark mb-4">
                <div class="card-header">
                  <h6 class="font-weight-bolder caret-down-c">
                    <a href="#faqFive" class="card-link d-flex justify-content-between align-item-center" data-toggle="collapse"> CAN I EDIT THIS FILE ?
                      <i class="fas fa-caret-down"></i>
                    </a>
                  </h6>
                </div>
                <div id="faqFive" class="collapse fade" >
                  <div class="card-body">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                  </div>
                </div>
              </div>
              <div class="card bg-dark mb-4">
                <div class="card-header">
                  <h6 class="font-weight-bolder caret-down-c">
                    <a href="#faqSix" class="card-link d-flex justify-content-between align-item-center" data-toggle="collapse"> HOW CAN I EDI THIS MASKS ?
                      <i class="fas fa-caret-down"></i>
                    </a>
                  </h6>
                </div>
                <div id="faqSix" class="collapse fade" >
                  <div class="card-body">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                  </div>
                </div>
              </div>
        </div>
      
    </div>
<style type="text/css">
.faq-one-column{
  background-color: #000000;
}
.faq-one-column{
  background-color: #000000;
}
.faq-one-column .caret-down-c a.active{
  color: #99de99;
}
.faq-one-column p{
  color: #818181;
}
</style>
<script type="text/javascript">
$(function(){

  $(".faq-one-column .caret-down-c a").click(function(event){
     var a=event.target;
     $(a).toggleClass("active");
     var i=$(a).children("i");
     if($(i).hasClass("fa-caret-down")){
        $(i).toggleClass("fa-caret-up")
     }
  });

});  
</script>

</div>
`
});


Vvveb.Blocks.add("bootstrap4/faqs-two-column", {
  name: t("Frequently Asked Questions-2"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/faqs1.png",
  html:`
<div class="faq-two-column" >
    <div class="container-sm text-white p-lg-4">
        <div class="main-heading text-center p-sm-5 m-sm-3 pb-3">
            <h1 class="text-center font-weight-bolder">FAQ</h1>
        </div>
      <div class="row">
          <div class="col-md-6 pb-3">
          
            <h5 class="font-weight-bolder">CAN I EDIT THIS FILE ?</h5>
            <div class="div-line"></div>
            <p class="py-2">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commod
            </p>

          </div>
          <div class="col-md-6 pb-3">
            <h5>IS IT LAYRED ?</h5>
            <div class="div-line"></div>
            <p class="py-2">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commod
            </p>
          </div>
          <div class="col-md-6 pb-3">
            <h5>HOW CAN I EDI THIS MASKS ?</h5>
            <div class="div-line"></div>
            <p class="py-2">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commod
            </p>
          </div>
          <div class="col-md-6 pb-3">
            <h5>WHAT DO I NEED TO OPEN THIS FILE ?</h5>
            <div class="div-line"></div>
            <p class="py-2">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commod
            </p>
          </div>
          <div class="col-md-6 pb-3">
            <h5 class="font-weight-bolder">CAN I EDIT THIS FILE ?</h5>
            <div class="div-line"></div>
            <p class="py-2">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commod
            </p>

          </div>
          <div class="col-md-6 pb-3">
            <h5>IS IT LAYRED ?</h5>
            <div class="div-line"></div>
            <p class="py-2">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commod
            </p>
          </div>
          <div class="col-md-6 pb-3">
            <h5>HOW CAN I EDI THIS MASKS ?</h5>
            <div class="div-line"></div>
            <p class="py-2">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commod
            </p>
          </div>
          <div class="col-md-6 pb-3">
            <h5>WHAT DO I NEED TO OPEN THIS FILE ?</h5>
            <div class="div-line"></div>
            <p class="py-2">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commod
            </p>
          </div>
      </div>
    </div>
 <style type="text/css">
.faq-two-column{
  background-color: #000000;
}
.faq-two-column .div-line{
    width: 50px;
    height: 5px;
    background-color: green;
}
.faq-two-column p{
  color: #818181;
}
</style>   
</div>

`
});

Vvveb.Blocks.add("bootstrap4/archives-four-column", {
  name: t("Archives Four Column"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/archive1.png",
  html:`

<div class="archive-four-clumn">
    <div class="container-fluid  mx-auto bg-white" style="max-width: 98%">
        <div class="text-center main-heading p-3 p-md-5" >
          <h1 class="font-weight-bolder text-white">News Letter</h1>
          <div class="text-white">
            Wait few minutes and read about all.
          </div>
        </div>
        <div class="row py-2">
            <div class="col-xl-3 py-4 col-md-6" >
              <div class="col-shadow" >
                <a href="#">
                  <div class="image">
                    <img src="https://source.unsplash.com/DYAf-8UTFN8/500x300" alt="compnay" class="d-block mx-auto" style="max-width: 100%">
                  </div>
                  <div class="p-2 text-left">
                      <div>
                        
                          <h4 class="text-primary">Satellites to protect the world, if data is open to</h4>
                        
                        <p style="text-overflow: ellipsis;" class="text-justifiy text-break">
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                         
                        </p>
                      </div>
                  </div>
                  <div class="border-top text-left p-2">
                    <div>
                      july 20, 2020 Category
                    </div>
                  </div>
                </a>
              </div>  
            </div>
            <div class="col-xl-3 py-4 col-md-6  ">
              <div class="col-shadow" >
                <a href="#">
                  <div class="image">
                    <img src="https://source.unsplash.com/-b7oBdnq40Y/500x300" alt="compnay" class="d-block mx-auto" >
                  </div>
                  <div class="p-2 text-left">
                      <div>
                          <h4 class="text-primary">Next COVID-19 outbreak ‘predicted all’</h4>
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                         
                        </p>
                      </div>
                  </div>
                  <div class="border-top text-left p-2">
                    <div>
                      july 20, 2020  Category
                    </div>
                  </div>
                </a>
              </div>  
            </div>
            <div class="col-xl-3 py-4 col-md-6">
              <div class="col-shadow" >
                <a href="#">
                  <div class="image">
                    <img src="https://source.unsplash.com/vriffJti0MY/500x300" alt="compnay" class="d-block mx-auto" >
                  </div>
                  <div class="p-2 text-left">
                      <div>
                          <h4 class="text-primary">Green energy revolution powered by global South</h4>
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                         
                        </p>
                      </div>
                  </div>
                  <div class="border-top text-left p-2">
                    <div>
                      july 20, 2020 Category
                    </div>
                  </div>
                </a>
              </div>  
            </div>
            <div class="col-xl-3 py-4 col-md-6">
              <div class="col-shadow" >
                <a href="#">
                  <div class="image">
                    <img src="https://source.unsplash.com/0x3zvwkQ-zo/500x300" alt="compnay" class="d-block mx-auto" >
                  </div>
                  <div class="p-2 text-left">
                      <div>
                          <h4 class="text-primary">Software developer by day, photographer by night</h4>
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                         
                        </p>
                      </div>
                  </div>
                  <div class="border-top text-left p-2">
                    <div>
                      july 20, 2020  Category
                    </div>
                  </div>
                </a>
              </div>  
            </div>
        </div>
        <div class="row py-2">
            <div class="col-xl-3 py-4 col-md-6" >
              <div class="col-shadow" >
                <a href="#">
                  <div class="image">
                    <img src="https://source.unsplash.com/DYAf-8UTFN8/500x300" alt="compnay" class="d-block mx-auto" >
                  </div>
                  <div class="p-2 text-left">
                      <div>
                        
                          <h4 class="text-primary">Satellites to protect the world, if data is open to</h4>
                        
                        <p style="text-overflow: ellipsis;" class="text-justifiy text-break">
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                         
                        </p>
                      </div>
                  </div>
                  <div class="border-top text-left p-2">
                    <div>
                      july 20, 2020 Category
                    </div>
                  </div>
                </a>
              </div>  
            </div>
            <div class="col-xl-3 py-4 col-md-6  ">
              <div class="col-shadow" >
                <a href="#">
                  <div class="image">
                    <img src="https://source.unsplash.com/-b7oBdnq40Y/500x300" alt="compnay" class="d-block mx-auto" >
                  </div>
                  <div class="p-2 text-left">
                      <div>
                          <h4 class="text-primary">Next COVID-19 outbreak ‘predicted all’</h4>
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                         
                        </p>
                      </div>
                  </div>
                  <div class="border-top text-left p-2">
                    <div>
                      july 20, 2020 Category
                    </div>
                  </div>
                </a>
              </div>  
            </div>
            <div class="col-xl-3 py-4 col-md-6">
              <div class="col-shadow" >
                <a href="#">
                  <div class="image">
                    <img src="https://source.unsplash.com/vriffJti0MY/500x300" alt="compnay" class="d-block mx-auto" >
                  </div>
                  <div class="p-2 text-left">
                      <div>
                          <h4 class="text-primary">Green energy revolution powered by global South</h4>
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                         
                        </p>
                      </div>
                  </div>
                  <div class="border-top text-left p-2">
                    <div>
                      july 20, 2020  Category
                    </div>
                  </div>
                </a>
              </div>  
            </div>
            <div class="col-xl-3 py-4 col-md-6">
              <div class="col-shadow" >
                <a href="#">
                  <div class="image">
                    <img src="https://source.unsplash.com/vriffJti0MY/500x300" alt="compnay" class="d-block mx-auto" >
                  </div>
                  <div class="p-2 text-left">
                      <div>
                          <h4 class="text-primary">Green energy revolution powered by global South</h4>
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                         
                        </p>
                      </div>
                  </div>
                  <div class="border-top text-left p-2">
                    <div>
                      july 20, 2020 Category
                    </div>
                  </div>
                </a>
              </div>  
            </div>
        </div>
    </div>
<style type="text/css">
.archive-four-clumn .container-fluid .main-heading{
background-color: #3494e6;
border-bottom-right-radius: 10px;
border-bottom-left-radius: 10px;
padding: 50px;
} 
.archive-four-clumn .container-fluid .col-shadow .image img{
  max-width: 100%;
  border-top-right-radius: 10px; 
  border-top-left-radius: 10px
}
.archive-four-clumn .container-fluid div a{
  text-decoration: none;
  color:#818181;
}
.archive-four-clumn .container-fluid div a:hover{
  text-decoration: none;
  color:#000000;
}
.archive-four-clumn .container-fluid .col-shadow{
    cursor: pointer;
    border-radius: 10px;
    transition: 0.4;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15) ,-1px -1px 10px rgba(0, 0, 0, 0.15);
}
.archive-four-clumn .container-fluid .col-shadow:hover{
    box-shadow: 0 10px 16px rgba(0,0,0,0.15);
    
}
</style>
</div>
`
});

Vvveb.Blocks.add("bootstrap4/features-with-image", {
  name: t("Features with image"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/features2.png",
  html:`

<div class="feature-with-image">
  
    <div class="container">
        <div class="row">
            <div class="col-lg-4 pt-5">
                <div>
                  <a href="#">
                    <div class="text-center p-2">
                      <i class='fas fa-paint-brush p-2 text-white'></i>  
                        <h4 class="text-light" >Web Designing</h4>
                    </div>
                    <div class="text-center">
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        </p>
                    </div>
                  </a>
                </div>
                <div>
                  <a href="#">
                    <div class="text-center  p-2">
                        <i class="fab fa-codepen  p-2  text-white"></i>
                        <h4 class="text-light">Dev Support</h4>
                    </div>
                    <div class="text-center">
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        </p>
                    </div>
                  </a>  
                </div> 
            </div>
            <div class="col-lg-4">
                <div class="image text-center ">
                    <img src="https://i.ibb.co/xF2PK8h/phone.png" class="d-block mx-auto" style="max-width: 100%" height="500px" alt="phone" border="0">
                    <h5><a href="#" class="text-center">Samsung 1.1</a></h5>
                </div>
            </div>
            <div class="col-lg-4 pt-5">
             <div>
               <a href="#">
                  <div class="text-center  p-2">
                     <i class="fas fa-bullseye  p-2  text-white" ></i>
                      <h4 class="text-light">Marketing</h4>
                  </div>
                  <div class="text-center">
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                      </p>
                  </div>
                </a> 
              </div>
              <div>
                <a href="#">
                  <div class="text-center  p-2">
                      <i class="fab fa-android  p-2  text-white"></i>
                      <h4 class="text-light">App development</h4>
                  </div>
                  <div class="text-center">
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                      </p>
                  </div>
                </a>
              </div>
            </div>
        </div>
    </div>
<style type="text/css">
.feature-with-image{
  background-color: #000000;
  color: #f1f1f1;
}
.feature-with-image a{
  transition: 0.8s;
  color: #818181;
}
.feature-with-image a:hover{
  color: #ffffff;
  text-decoration: none;
}
.feature-with-image  .fab,
.feature-with-image  .fas{
  font-size: 2em;
}
</style>
</div>
`
});

Vvveb.Blocks.add("bootstrap4/features-three-column", {
  name: t("Features with three column"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/features1.png",
  html:`
  <div class="feature-three-column mx-auto  py-3" >
    <div class="container">
          <div class="text-center w-sm-50 mx-auto py-4">
              <h1 class="text-center font-weight-bolder py-2 ">Features</h1>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                consectetur adipisicing elit, sed do eiusmod
              </p>
          </div>
        <div class="row  justify-content-center py-4">
            <div class="col-lg-4 text-center">
                  <a href="#"><h2 style="font-family: sans-serif;">Graphic Designing</h2></a>
                  <div class="text-center">
                      <a href="#"><p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                      </p></a>
                  </div>
             
            </div>
            <div class="col-lg-4 text-center">
                  <a href="#"><h2 style="font-family: sans-serif;">Management</h2></a>
                  <div class="text-center">
                      <a href="#"><p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                      </p></a>
                  </div>
            </div>
            <div class="col-lg-4 text-center">
                  <a href="#"><h2 style="font-family: sans-serif;">Developing</h2></a>
                <div class="text-center">
                    <a href="#"><p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    </p></a>
                </div>
            </div>
        </div>
    </div>
<style type="text/css">
.feature-three-column{
  background-color: #000000;
  color: #f1f1f1;
}
.feature-three-column a{
  transition: 0.8s;
  color: #818181;
}
.feature-three-column a h2{
  transition: 0.8s;
  color: #ffffff;
}
.feature-three-column a:hover{
  color: #ffffff;
  text-decoration: none;
}
.feature-three-column a:hover h2{
  color: #818181;
}
.feature-three-column  .fab,
.feature-three-column  .fas{
  font-size: 4em;
}
</style>
</div>
`
});


Vvveb.Blocks.add("bootstrap4/contact-us-with-map", {
  name: t("Contact Us block with Google Map"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/contact2.png",
  html:`
<div class="contact-us-with-map" >
    <div class="container-sm text-white p-lg-4">
        <div class="py-3 pl-5">
          <h1 class="text-center text-lg-left font-weight-bolder pt-4" style="font-family: sans-serif;">Contact Us</h1>
          <p  style="color: #ffffff" class="text-lg-left text-center">Leave us message</p>
        </div>
        <div class="row mx-auto  container-sm">
            <div class="col-md-6 p-1  p-md-5 text-left">
                  <form>
                    <div class="form-group form-group py-1 py-lg-3">
                      <input type="text" name="name" id="name" required="required"  class="form-control " placeholder="Enter Name">
                    </div>
                    <div class="form-group py-lg-3 py-1">
                      <input type="email" name="email" id="email" class="form-control py-2" required="required" placeholder="Enter Email">
                    </div>
                    <div class="form-group py-1 py-lg-3">
                      <textarea name="message" id="message" class="form-control py-2" required="required" placeholder="Enter Message..."></textarea>
                    </div>
                    <input type="submit" name="submit"  value="Send Message" class="btn btn-light border p-1 mb-5">
                  </form>
            </div>
            <div class="col-md-6 pl-md-4">
                  <div class="google-map">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3023.4774996550136!2d-73.998649585095!3d40.72951744448146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2599af55395c1%3A0xda30743171b5f305!2sNew%20York%20University!5e0!3m2!1sen!2sin!4v1593777554327!5m2!1sen!2sin" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                  </div>
                <h6 class="py-1">Phone: +98 124521511</h6>  
                <h6 class="py-1">Email: johndoe@example.com</h6>
                <h6 class="py-1">Address: street 22, city , district, country</h6>  
                <div>
                  Mon-Fri 9:00AM to 6:00PM
                </div>
                  <div class="social-icon p-2 py-3">
                    <a href="#" title="follow on instagram" class="pr-3  d-inline-block text-white"><i class='fab fa-instagram'></i></a>
                    <a href="#" title="follow on twitter"  class="pr-3 d-inline-block text-white"><i class='fab fa-twitter'></i></a>
                    <a href="#" title="follow on Google+"  class="pr-3 d-inline-block text-white"><i class='fab fa-google-plus'></i></a>
                    <a href="#" title="follow on LinkedIn "  class="pr-3 d-inline-block text-white"><i class='fab fa-linkedin'></i></a>
                    <a href="#" title="follow on LinkedIn "  class="pr-3 d-inline-block text-white"><i class='fab fa-facebook'></i></a>
                  </div>
            </div>
        </div>
    </div>
<style type="text/css">
.contact-us-with-map{
  background-color: #000000;
}
.contact-us-with-map .form-group .form-control{
  background-color: #000000;
  border:1px solid #818181;
  color: #f1f1f1;
  resize: none;
}
</style>
</div>


`});

Vvveb.Blocks.add("bootstrap4/contact-us", {
  name: t("Contact us block"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/contact1.png",
  html:`
 <div class="contact-us-one" >
    <div class="container-sm text-white p-lg-4">
        <div class="py-3 pl-5">
          <h1 class="text-center text-lg-left font-weight-bolder" style="font-family: sans-serif;">Contact Us</h1>
        </div>
        <div class="row mx-auto  container-sm">
            <div class="col-md-6 py-md-5 pl-md-4 order-2 order-md-2">
                <h5 class="py-2">Phone: +98 124521511</h5>  
                <h5 class="py-2">Email: johndoe@example.com</h5>  
                <h5 class="py-2">Address: street 22, city , district, country</h5>
                <div>
                  Mon-Fri 9:00AM to 6:00PM
                </div>

                  <div class="social-icon p-2 py-3">
                    <a href="#" title="follow on instagram" class="pr-3  d-inline-block text-white"><i class='fab fa-instagram'></i></a>
                    <a href="#" title="follow on twitter"  class="pr-3 d-inline-block text-white"><i class='fab fa-twitter'></i></a>
                    <a href="#" title="follow on Google+"  class="pr-3 d-inline-block text-white"><i class='fab fa-google-plus'></i></a>
                    <a href="#" title="follow on LinkedIn "  class="pr-3 d-inline-block text-white"><i class='fab fa-linkedin'></i></a>
                    <a href="#" title="follow on LinkedIn "  class="pr-3 d-inline-block text-white"><i class='fab fa-facebook'></i></a>
                  </div>
            </div>
            <div class="col-md-6 p-1  p-md-5 text-left order-1 order-md-2">
                  <form>
                    <div class="form-group form-group">
                      <input type="text" name="name" id="name" required="required"  class="form-control " placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                      <input type="email" name="email" id="email" class="form-control " required="required" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                      <textarea name="message" id="message" class="form-control" required="required" placeholder="Enter Message..."></textarea>
                    </div>
                    <input type="submit" name="submit"  value="Send Message" class="btn btn-light border mb-5">
                  </form>
            </div>
        </div>
    </div>
<style type="text/css">
.contact-us-one{
  background-color: #000000;
}
.contact-us-one .form-group .form-control{
  background-color: #000000;
  border:1px solid #818181;
  color: #f1f1f1;
  resize: none;
}
</style>
</div>
`
});

Vvveb.Blocks.add("bootstrap4/navbar-with-address-social-icon", {
  name: t("Navbar with address and social icon"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/header2.png",
  html:`
  
<div class="navbar-with-address-social-icon" >
    <div class="container-fluid text-white">
        <div class="row top-header">
            <div class="col-lg-9 column-xl-9">
                <div class="row">
                    <div class="col-sm-4">
                      <div class="row">
                          <div class="col-sm-1 ">
                            <i class="fas fa-envelope" ></i>
                          </div>
                          <div class="col-md-10 ">
                            <h6>johndoe@example.com</h6>
                          </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="row">
                          <div class="col-sm-1">
                            <i class="fas fa-phone-alt"></i>
                          </div>
                          <div class="col-md-10">
                            <h6>+87 34346644433</h6>
                          </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="row">
                          <div class="col-sm-1 ">
                            <i class="fas fa-clock"></i>
                          </div>
                          <div class="col-md-10">
                            <h6>Mon-Fri 9:00-17:30</h6>
                          </div>
                      </div>
                    </div>
                </div>
            </div>        
            <div class="col-lg-3 text-left justify-content-end">
                <div class="clearfix">
                    <div class="social-icon float-right">
                      <a href="#" title="follow on instagram" class="mr-1 text-white"><i class='fab fa-instagram'></i></a>
                      <a href="#" title="follow on twitter"  class="mr-1 text-white"><i class='fab fa-twitter'></i></a>
                      <a href="#" title="follow on Google+"  class="mr-1 text-white"><i class='fab fa-google-plus'></i></a>
                      <a href="#" title="follow on LinkedIn "  class="mr-1 text-white"><i class='fab fa-linkedin'></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-logo text-center p-2">
          <div>
            <img src="https://i.ibb.co/NSMQMPc/logo.png" alt="logo" border="0" class="mx-auto d-block p-2">

          <h4 class="text-dark p-2">Compnay Name</h4>
          </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-md active sticky-top">
      <a class="navbar-brand  pl-4" href="#">Home</a>
      <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item p-1 px-3">
            <a class="nav-link" href="#">Produts</a>
          </li>
          <li class="nav-item p-1  px-3">
            <a class="nav-link" href="#">Service</a>
          </li>
          <li class="nav-item p-1  px-3">
            <a class="nav-link" href="#">Client</a>
          </li>
          <li class="nav-item p-1  px-3">
            <a class="nav-link" href="#">Contact Us</a>
          </li>
          <li class="nav-item p-1  px-3">
            <a class="nav-link" href="#">About Us</a>
          </li>
          <li class="nav-item p-1  px-3">
            <a class="nav-link" href="#">Other</a>
          </li>    
        </ul>
      </div>  
</nav>
<style type="text/css">
.navbar-with-address-social-icon{
  background-color:#ffffff;
}
.navbar-with-address-social-icon .top-header{
  background-color: #02d1ae;
  padding: 10px;
}
.navbar-with-address-social-icon i{
color:#f1f1f1;
}
.navbar-with-address-social-icon h6,
.navbar-with-address-social-icon p{
  color:#f1f1f1;
  
}
.navbar-with-address-social-icon .navbar a{
  font-size: 1.2em;
}

.navbar-with-address-social-icon .navbar{
  padding: 0;
  transition: 0.5s;
  border-top: 2px solid #cccccc;
  border-bottom: 2px solid #cccccc;
  margin: 0;
}
.navbar-with-address-social-icon .fa-bars {
  color: #02d1ae;
  font-size: 2em;
}
.navbar-with-address-social-icon .navbar-brand{
  color: #02d1ae;
  padding: 12px 0px;
  transition: 0.5s;
  border-top: 5px solid;
  border-bottom: 5px solid;
  border-color: transparent;;
}
.navbar-with-address-social-icon .navbar .navbar-nav a{
  color: #02d1ae;
}
.navbar-with-address-social-icon .navbar .navbar-nav li{
  border-bottom: 5px solid;
  border-top: 5px solid;
  border-color: transparent;;
}

.navbar-with-address-social-icon .navbar .navbar-nav li:hover,
.navbar-with-address-social-icon .navbar-brand:hover{
  border-color: #02d1ae;
}
</style>
</div>
  `
});

Vvveb.Blocks.add("bootstrap4/navbar-with-address", {
  name: t("Navbar with address"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/header1.png",
  html:`
<div class="navbar-with-address" >
    <div class="container-fluid text-white">
        <div class="row">
            <div class="col-xl-3 brand text-center">
                <img src="https://i.ibb.co/mHCkkLk/logo1.png" alt="logo1" class="mx-auto d-block p-5" border="0">
            </div>
            <div class="col-xl-9 column-xl-9">
                <div class="row">
                    <div class="col-sm-4">
                      <div class="row">
                          <div class="col-sm-1 py-4 pr-4">
                            <i class="fas fa-map-marker-alt" ></i>
                          </div>
                          <div class="col-md-10  py-3 pl-4">
                            <h5>123 Street</h5>
                            <p>Newyork America</p>
                          </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="row">
                          <div class="col-sm-1 py-4 pr-4">
                            <i class="fas fa-phone-alt"></i>
                          </div>
                          <div class="col-md-10 py-3 pl-5 ">
                            <h5>+87 34346644433</h5>
                            <p>24/7 Customer Support</p>
                          </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="row">
                          <div class="col-sm-1 py-4 pr-4 ">
                            <i class="fas fa-clock"></i>
                          </div>
                          <div class="col-md-10 py-3 pl-5">
                            <h5>Mon-Fri 9:00-17:30</h5>
                            <p>Online Store Always open</p>
                          </div>
                      </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
    <nav class="navbar navbar-expand-md active  sticky-top">
      <a class="navbar-brand  pl-4" href="#">Home</a>
      <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item p-1 px-3">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item p-1  px-3">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item p-1  px-3">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item p-1  px-3">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item p-1  px-3">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item p-1  px-3">
            <a class="nav-link" href="#">Link</a>
          </li>    
        </ul>
      </div>  
</nav>
<style>
.navbar-with-address{
  background-color:#ececf742;
}
.navbar-with-address i{
  font-size: 2em;
color:#040494;
}
.navbar-with-address h5,
.navbar-with-address p{
  color:#040494;
  
}
.navbar-with-address .navbar a{
  font-size: 1.2em;
}
.navbar-with-address .column-xl-9{
  display: none;
}
.navbar-with-address .navbar{
  background-color: #0c1975c4;
  color: #ffffff; 
  padding: 0;
  transition: 0.5s;
  margin: 0;
}
.navbar-with-address .fa-bars {
  color: #ffffff;
  font-size: 2em;
}
.navbar-with-address .navbar-brand{
  color: #ffffff;
  padding: 12px 0px;
  transition: 0.5s;
  border-bottom: 4px solid;
  border-color: transparent;;
}
.navbar-with-address .navbar .navbar-nav a{
  color: #ffffff;
}
.navbar-with-address .navbar .navbar-nav li{
  border-bottom: 4px solid;
  border-color: transparent;;
}

.navbar-with-address .navbar .navbar-nav li:hover,
.navbar-with-address .navbar-brand:hover{
  border-color: #f3f329;
}
@media screen and (min-width: 766px){
    .navbar-with-address .column-xl-9{
      display: block;
    }
}
</style>
</div>  
`
});



Vvveb.Blocks.add("bootstrap4/navbar-with-address", {
  name: t("Navbar with address-2"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/header1.png",
  html:`
<div class="navbar-with-address" >
    <div class="container-fluid text-white">
        <div class="row">
            <div class="col-xl-3 brand text-center">
                <img src="https://i.ibb.co/mHCkkLk/logo1.png" alt="logo1" class="mx-auto d-block p-5" border="0">
            </div>
            <div class="col-xl-9 column-xl-9">
                <div class="row">
                    <div class="col-sm-4">
                      <div class="row">
                          <div class="col-sm-1 py-4 pr-4">
                            <i class="fas fa-map-marker-alt" ></i>
                          </div>
                          <div class="col-md-10  py-3 pl-4">
                            <h5>123 Street</h5>
                            <p>Newyork America</p>
                          </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="row">
                          <div class="col-sm-1 py-4 pr-4">
                            <i class="fas fa-phone-alt"></i>
                          </div>
                          <div class="col-md-10 py-3 pl-5 ">
                            <h5>+87 34346644433</h5>
                            <p>24/7 Customer Support</p>
                          </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="row">
                          <div class="col-sm-1 py-4 pr-4 ">
                            <i class="fas fa-clock"></i>
                          </div>
                          <div class="col-md-10 py-3 pl-5">
                            <h5>Mon-Fri 9:00-17:30</h5>
                            <p>Online Store Always open</p>
                          </div>
                      </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
    <nav class="navbar navbar-expand-md active  sticky-top">
      <a class="navbar-brand  pl-4" href="#">Home</a>
      <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item p-1 px-3">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item p-1  px-3">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item p-1  px-3">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item p-1  px-3">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item p-1  px-3">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item p-1  px-3">
            <a class="nav-link" href="#">Link</a>
          </li>    
        </ul>
      </div>  
</nav>
<style>
.navbar-with-address{
  background-color:#ececf742;
}
.navbar-with-address i{
  font-size: 2em;
color:#040494;
}
.navbar-with-address h5,
.navbar-with-address p{
  color:#040494;
  
}
.navbar-with-address .navbar a{
  font-size: 1.2em;
}
.navbar-with-address .column-xl-9{
  display: none;
}
.navbar-with-address .navbar{
  background-color: #0c1975c4;
  color: #ffffff; 
  padding: 0;
  transition: 0.5s;
  margin: 0;
}
.navbar-with-address .fa-bars {
  color: #ffffff;
  font-size: 2em;
}
.navbar-with-address .navbar-brand{
  color: #ffffff;
  padding: 12px 0px;
  transition: 0.5s;
  border-bottom: 4px solid;
  border-color: transparent;;
}
.navbar-with-address .navbar .navbar-nav a{
  color: #ffffff;
}
.navbar-with-address .navbar .navbar-nav li{
  border-bottom: 4px solid;
  border-color: transparent;;
}

.navbar-with-address .navbar .navbar-nav li:hover,
.navbar-with-address .navbar-brand:hover{
  border-color: #f3f329;
}
@media screen and (min-width: 766px){
    .navbar-with-address .column-xl-9{
      display: block;
    }
}
</style>
</div>  
`
});

Vvveb.Blocks.add("bootstrap4/about-with-header-image", {
  name: t("About Block"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/about2.png",
  html:`
<div class="about-with-header-image px-md-5 py-3 px-2 ">
  <div class="container-fluid" >
       <div class="about-image">
         <img src="https://source.unsplash.com/1600x600/?technology,equipment" style="max-width: 100%;" class="d-block mx-auto">
       </div>
    <div class="py-2">
      <h2 class="font-weight-bolder">About Company</h2>
      <p class="font-weight-bold" style="font-family: sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
    </div>
    <div class="row description">
      <div class="col-md-6">
          <p class="text-justify text-break">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.  
          </p>
      </div>
      <div class="col-md-6">
          <p class="text-justify text-break">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
      </div>
    </div>
     <div class="py-2">
      <h2 class="font-weight-bolder">About Company</h2>
      <p class="font-weight-bold" style="font-family: sans-serif;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
    </div>
    <div class="row description">
      <div class="col-md-6">
          <p class="text-justify text-break">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.  
          </p>
      </div>
      <div class="col-md-6">
          <p class="text-justify text-break">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
      </div>
    </div>
  </div>
.about-with-header-image{
  background-color: #401d2d;
  color: #cea16a;
}
.about-with-header-image .description{
  color: #bd9667;
}
</div>
`,
});

Vvveb.Blocks.add("bootstrap4/about-with-side-image", {
  name: t("About with side image"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/about1.png",
  html:`
<div class="about-one bg-dark" >
    <div class="container-fluid text-white">
        <div class="row">
            <div class="col-xl-5">
              <div>
                  
                  <img src="https://source.unsplash.com/bF2vsubyHcQ/1920x1320" width="100%" class="mt-2" >  
              </div>
            </div>
            <div class="col-xl-7 mt-3">
              <div>
                <h1>About Compnay</h1>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                  cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
              </div>
              <div>
                <h1>Our Vision</h1>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                  cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
              </div>
            </div>
        </div>
    </div>
<style type="text/css">
.about-one{
  background-color: #000000;
  margin: 15px;
  padding: 60px;
}

@media screen and (max-width: 580px){
  .about-one{
    margin: 2px;
    padding: 2px;
  }
}
</style>
</div>
`,
});

Vvveb.Blocks.add("bootstrap4/services-two-column", {
  name: t("Services with two column"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/service2.png",
  html:`
<div class="service-two-column mx-auto  py-3" >
    <div class="container">
        <h1 class="text-center p-5 mb-4 font-weight-bolder text-lg-left ">Our Services</h1>
        <div class="row  justify-content-center">
            <div class="col-md-6">
              <div class="row">
                  <div class="col-lg-1  mr-3 mr-md-3">
                    <div class="text-center  ">
                      <a href="#">
                        <i class='fas fa-paint-brush'></i>  
                      </a>
                    </div>                
                </div>
                <div class="col-lg-10 column-10 text-center text-lg-left">
                    <div class="px-2 px-md-1">
                      <a href="#">
                        <h4  class="pt-1" style="font-family: sans-serif;">Web Designing</h4>
                      </a> 
                      <p>
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                      </p>
                    </div>
                  </div>
              </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                  <div class="col-lg-1  mr-3 mr-md-3">
                      <div class="text-center ">
                        <a href="#">
                          <i class="fab fa-chrome"></i>  
                        </a>
                      </div>                
                  </div>
                  <div class="col-lg-10  column-10  text-center  text-lg-left">
                      <div>
                        <a href="#">
                          <h4 class="pt-1" style="font-family: sans-serif;">Web Designing</h4>
                        </a>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        </p>
                      </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="row  justify-content-center">
            <div class="col-md-6">
              <div class="row">
                  <div class="col-lg-1 mr-3 mr-md-3">
                    <div class="text-center   ">
                      <a href="#"> 
                        <i class="fab fa-android "></i>  
                      </a>
                    </div>                
                </div>
                <div class="col-lg-10  column-10  text-center text-lg-left ">
                    <div>
                        <a href="#">
                          <h4 class="pt-1" style="font-family: sans-serif;">App development</h4>
                        </a>
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        </p>
                    </div>
                  </div>
              </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                  <div class="col-lg-1  mr-3 mr-md-3">
                      <div class="text-center ">
                          <a href="#">
                            <i class="fas fa-chart-line "></i>  
                          </a>
                      </div>                
                  </div>
                  <div class="col-lg-10 column-10  text-center text-lg-left">
                      <div>
                          <a href="#">
                            <h4 class="pt-2" style="font-family: sans-serif;">Consultancy</h4>
                          </a>
                          <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                          </p>
                      </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="row  justify-content-center">
            <div class="col-md-6">
              <div class="row">
                  <div class="col-lg-1 mr-3 mr-md-3">
                    <div class="text-center   ">
                      <a href="#"> 
                        <i class="fab fa-microsoft"></i>
                      </a>
                    </div>                
                </div>
                <div class="col-lg-10  column-10  text-center text-lg-left ">
                    <div>
                        <a href="#">
                          <h4 class="pt-1" style="font-family: sans-serif;">Brand Strategy</h4>
                        </a>
                        <p>
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        </p>
                    </div>
                  </div>
              </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                  <div class="col-lg-1  mr-3 mr-md-3">
                      <div class="text-center ">
                          <a href="#">
                            <i class="fas fa-adjust" ></i>
                          </a>
                      </div>                
                  </div>
                  <div class="col-lg-10 column-10  text-center text-lg-left">
                      <div>
                          <a href="#">
                            <h4 class="pt-2" style="font-family: sans-serif;">Graphic design</h4>
                          </a>
                          <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                          </p>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
<style type="text/css">
.service-two-column{
  background-color: #000000;
  color: #f1f1f1;
}
.service-two-column a{
  transition: 0.5s;
  color: #ffffff;
}
.service-two-column  .column-10 p{
  color: #818181;
}

.fab,
.fas{
  font-size: 3em;
  color: #818181;
  transition: 0.5s;
}

.service-two-column a:hover,
.service-two-column i:hover{
  color: #818181;
  text-decoration: none;
}
.service-two-column i:hover{
  color: #ffffff;
}
</style>
</div>
`,
});

Vvveb.Blocks.add("bootstrap4/services-three-column", {
  name: t("Services with three column"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/service1.png",
  html:`
<div class="service-three-column mx-auto  py-3" >
    <div class="container">
        <h1 class="text-center p-5 mb-4 font-weight-bolder ">Our Services</h1>
        <div class="row  justify-content-center">
            <div class="col-lg-4">
              <a href="#">
                <div>
                  <div class="text-center p-2">
                    <i class='fas fa-paint-brush p-2'></i>  
                      <h2 style="font-family: sans-serif;">Web Designing</h2>
                  </div>
                  <div class="text-center">
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                      </p>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-4">
              <a href="#">
                <div>
                  <div class="text-center  p-2">
                      <i class="fab fa-chrome  p-2"></i>
                      <h2>Web Development</h2>
                  </div>
                  <div class="text-center">
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                      </p>
                  </div>
                </div> 
              </a>
            </div>
            <div class="col-lg-4">
             <a href="#">
             <div>
                <div class="text-center  p-2">
                   <i class="fas fa-adjust  p-2" ></i>
                    <h2 style="font-family: sans-serif;">Graphic design</h2>
                </div>
                <div class="text-center">
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    </p>
                </div>
              </div>
            </a>
            </div>
        </div>
        <div class="row  justify-content-center mt-3">
            <div class="col-lg-4">
              <a href="#">
              <div>
                <div class="text-center  p-2">
                    <i class="fab fa-android  p-2"></i>
                    <h2 style="font-family: sans-serif;">App development</h2>
                </div>
                <div class="text-center">
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    </p>
                </div>
              </div>
            </a>
            </div>
            <div class="col-lg-4">
                <a href="#">
              <div>
                <div class="text-center  p-2">
                    <i class="fas fa-chart-line  p-2"></i>
                    <h2 style="font-family: sans-serif;">Consultancy</h2>
                </div>
                <div class="text-center">
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    </p>
                </div>
              </div>
            </a>
            </div>
            <div class="col-lg-4">
              <a href="#">
             <div>
                <div class="text-center  p-2">
                    <i class="fab fa-microsoft  p-2"></i>
                    <h2 style="font-family: sans-serif;">Brand Strategy</h2>
                </div>
                <div class="text-center">
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    </p>
                </div>
              </div>
            </a>
            </div>
        </div>
    </div>
<style type="text/css">
.service-three-column{
  background-color: #000000;
  color: #f1f1f1;
}
.service-three-column a{
  transition: 0.8s;
  color: #818181;
}
.service-three-column a:hover{
  color: #ffffff;
  text-decoration: none;
}
.service-three-column  .fab,
.service-three-column  .fas{
  font-size: 4em;
}
</style>
</div>
`,
});

Vvveb.Blocks.add("bootstrap4/team-three-column", {
  name: t("Team with three column"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/team3.png",
  html:`
<div class="team-three-column mx-auto bg-dark py-3" >
    <div class="container">

        <div class="row text-white justify-content-center">
            <div class="col-sm-4">
              <div>
                <div class="text-center">
                    <img width="110px" src="https://source.unsplash.com/TMgQMXoglsM/500x500" class="rounded-circle" alt="...">
                    <h2 style="font-family: sans-serif;">John Doe</h2>
                    <h4 class="text-secondary">Founder</h4>
                </div>
                <div class="text-center">
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    </p>
                </div>
                <div class="text-center">
                   <div class="social-icon">
                  <a href="#" title="follow on instagram" class="mr-2 text-white"><i class='fab fa-instagram'></i></a>
                  <a href="#" title="follow on twitter"  class="mr-2 text-white"><i class='fab fa-twitter'></i></a>
                  <a href="#" title="follow on Google+"  class="mr-2 text-white"><i class='fab fa-google-plus'></i></a>
                  <a href="#" title="follow on LinkedIn "  class="mr-2 text-white"><i class='fab fa-linkedin'></i></a>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div>
                <div class="text-center">
                    <img width="110px" src="https://source.unsplash.com/sNut2MqSmds/500x500" class="rounded-circle" alt="...">
                    <h2 style="font-family: sans-serif;">John Doe</h2>
                    <h4 class="text-secondary">Designer</h4>
                </div>
                <div class="text-center">
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    </p>
                </div>
                <div class="text-center">
                   <div class="social-icon">
                  <a href="#" title="follow on instagram" class="mr-2 text-white"><i class='fab fa-instagram'></i></a>
                  <a href="#" title="follow on twitter"  class="mr-2 text-white"><i class='fab fa-twitter'></i></a>
                  <a href="#" title="follow on Google+"  class="mr-2 text-white"><i class='fab fa-google-plus'></i></a>
                  <a href="#" title="follow on LinkedIn "  class="mr-2 text-white"><i class='fab fa-linkedin'></i></a>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
             <div>
                <div class="text-center">
                    <img width="110px" src="https://source.unsplash.com/9UVmlIb0wJU/500x500" class="rounded-circle" alt="...">
                    <h2 style="font-family: sans-serif;">John Doe</h2>
                    <h4 class="text-secondary">Developer</h4>
                </div>
                <div class="text-center">
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    </p>
                </div>
                <div class="text-center">
                   <div class="social-icon">
                  <a href="#" title="follow on instagram" class="mr-2 text-white"><i class='fab fa-instagram'></i></a>
                  <a href="#" title="follow on twitter"  class="mr-2 text-white"><i class='fab fa-twitter'></i></a>
                  <a href="#" title="follow on Google+"  class="mr-2 text-white"><i class='fab fa-google-plus'></i></a>
                  <a href="#" title="follow on LinkedIn "  class="mr-2 text-white"><i class='fab fa-linkedin'></i></a>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
<style type="text/css">
.team-three-column .team-two-column-image{
  padding-right: 0;
  margin-right: 0;
}
</style>
</div>
`,
});




Vvveb.Blocks.add("bootstrap4/team-two-column", {
  name: t("Team with two column"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/team2.png",
  html:`
<div class="team-two-column mx-auto bg-dark py-3" >
    <div class="container">

        <div class="row text-white">
            <div class="col-sm-6 p-2">
                <div class="row">
                  <div class="col-md-3 team-two-column-image text-left">
                      <img width="130px" src="https://source.unsplash.com/9UVmlIb0wJU/500x500" class="rounded-circle  img-thumbnail" alt="...">
                  </div>
                  <div class="col-lg-8 mt-4 text-left">
                    <h3>John Doe</h3>
                    <h5>Designer</h5>
                    <div class="social-icon">
                  <a href="#" title="follow on instagram" class="mr-1 text-white"><i class='fab fa-instagram'></i></a>
                  <a href="#" title="follow on twitter"  class="mr-1 text-white"><i class='fab fa-twitter'></i></a>
                  <a href="#" title="follow on Google+"  class="mr-1 text-white"><i class='fab fa-google-plus'></i></a>
                  <a href="#" title="follow on LinkedIn "  class="mr-1 text-white"><i class='fab fa-linkedin'></i></a>
                    </div>
                  </div>
                </div>
                <p class="py-2 text-break">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                </p>
            </div>
           <div class="col-sm-6 p-2">
                <div class="row">
                  <div class="col-md-3 team-two-column-image text-left">
                  <img width="130px" src="https://source.unsplash.com/TMgQMXoglsM/500x500" class="rounded-circle  img-thumbnail " alt="...">
                  </div>
                  <div class="col-lg-8 mt-4 text-left">
                    <h3>Ana Batson</h3>
                    <h5>Developer</h5>
                    <div class="social-icon">
                  <a href="#" title="follow on instagram" class="mr-1 text-white"><i class='fab fa-instagram'></i></a>
                  <a href="#" title="follow on twitter"  class="mr-1 text-white"><i class='fab fa-twitter'></i></a>
                  <a href="#" title="follow on Google+"  class="mr-1 text-white"><i class='fab fa-google-plus'></i></a>
                  <a href="#" title="follow on LinkedIn "  class="mr-1 text-white"><i class='fab fa-linkedin'></i></a>
                    </div>
                  </div>
                </div>
                <p class="py-2 text-break">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                </p>
            </div>
        </div>
    </div>
<style>
.team-two-column .team-two-column-image{
  padding-right: 0;
  margin-right: 0;
}
.team-two-column {
  max-width: 1200px;
}
</style>
</div>
`,
});


Vvveb.Blocks.add("bootstrap4/modern-testimonial-one-column", {
  name: t("Modren Testimonial with one column"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/testimonial3.png",
  html:`

<div class="modern-testimonial-one-column">
  <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">

  <!-- Indicators -->
  <ul class="carousel-indicators pb-1">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ul>
  
  <!-- The slideshow -->
  <div class="carousel-inner" style="background-color: #000000;">
    <div class="carousel-item text-center p-4 active" >
        <div class="m-5 text-center w-75 mx-auto text-white container">
              <h2 class="mb-3">Happy Customer</h2>
              <img src="https://source.unsplash.com/1000x1000/?person,girl" width="150px" title="avatar" class="rounded-circle img-thumbnail d-block mx-auto mt-3" >
            <p style="color: #f2f2f2">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <h3>Ana batson</h3>
            <h5>Ceo Amezon</h5>
        </div>
    </div>
    <div class="carousel-item text-center p-4">
        <div class=" m-5 text-center w-75 mx-auto text-white container">
              <h2 class="mb-3">Happy Customer</h2>
              <img src="https://source.unsplash.com/1000x1000/?person,doctor" width="150px" title="avatar" class="rounded-circle img-thumbnail d-block mx-auto mt-3" >
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <h3>John Doe</h3>
            <h5>Ceo Amezon</h5>
        </div>
    </div>
    <div class="carousel-item p-4">
        <div class="text-white w-75 mx-auto m-5 text-center  container">
              <h2 class="mb-3">Happy Customer</h2>
              <img src="https://source.unsplash.com/1000x1000/?person,doctor" width="150px" title="avatar" class="rounded-circle img-thumbnail d-block mx-auto mt-3" >
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <h3>Lrem Ispum</h3>
            <h5>Ceo zeevi</h5>
        </div>
    </div>
  </div>
  
    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>
</div>
<style>
.modern-testimonial-one-column .carousel-indicators li{
    width: 10px;
    height: 10px;
    border-radius: 50%;
}
.modern-testimonial-one-column .carousel-control-prev{
    z-index: 99 !important;
    background-color: #000000;
  }
.modern-testimonial-one-column .carousel-control-next{
    background-color: #000000;
    z-index: 99 !important;
}
  </style>

</div>

`,
});

Vvveb.Blocks.add("bootstrap4/footer-upper-social-icon", {
  name: t("Modren Footer with Upper social icon"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/footer_upper_social_icon.png",
  html:`
<div class="footer-upper-social-icon mt-3 bg-dark">
  <hr />
  <!-- Social buttons -->
   <ul class="list-unstyled mt-2 list-inline text-center footer-social-icon">
     <li class="list-inline-item fa-facebook-1">
       <a class="btn-floating btn-fb mx-1">
         <i class="fab fa-facebook-f"> </i>
       </a>
     </li>
     <li class="list-inline-item  fa-twitter-1">
       <a class="btn-floating btn-tw mx-1">
         <i class="fab fa-twitter"> </i>
       </a>
     </li>
     <li class="list-inline-item fa-google-plus-g-1">
       <a class="btn-floating btn-gplus mx-1">
         <i class="fab fa-google-plus-g"> </i>
       </a>
     </li>
     <li class="list-inline-item fa-linkedin-in-1">
       <a class="btn-floating btn-li mx-1">
         <i class="fab fa-linkedin-in"> </i>
       </a>
     </li>
     <li class="list-inline-item fa-dribbble-1">
       <a class="btn-floating btn-dribbble mx-1">
         <i class="fab fa-dribbble"> </i>
       </a>
     </li>
   </ul>
   <!-- Social buttons -->
 
 
 <!-- Footer -->
 <footer class="page-footer font-small stylish-color-dark pt-4">
 
   <!-- Footer Links -->
   <div class="container text-center text-md-left">
 
     <!-- Grid row -->
     <div class="row">
 
       <!-- Grid column -->
       <div class="col-md-4 mx-auto text-white">
 
         <!-- Content -->
         <h5 class="font-weight-bold text-white text-uppercase mt-3 mb-4">Your Footer Content</h5>
         <p>Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit amet,
           consectetur
           adipisicing elit.</p>
 
       </div>
       <!-- Grid column -->
 
       <hr class="clearfix w-100 d-md-none">
 
       <!-- Grid column -->
       <div class="col-md-2 mx-auto">
 
         <!-- Links -->
         <h5 class="font-weight-bold text-white text-uppercase mt-3 mb-4">Links</h5>
 
         <ul class="list-unstyled">
           <li>
             <a href="#!">Link 1</a>
           </li>
           <li>
             <a href="#!">Link 2</a>
           </li>
           <li>
             <a href="#!">Link 3</a>
           </li>
           <li>
             <a href="#!">Link 4</a>
           </li>
         </ul>
 
       </div>
       <!-- Grid column -->
 
       <hr class="clearfix w-100 d-md-none">
 
       <!-- Grid column -->
       <div class="col-md-2 mx-auto">
 
         <!-- Links -->
         <h5 class="font-weight-bold text-white text-uppercase mt-3 mb-4">Links</h5>
 
         <ul class="list-unstyled">
           <li>
             <a href="#!">Link 1</a>
           </li>
           <li>
             <a href="#!">Link 2</a>
           </li>
           <li>
             <a href="#!">Link 3</a>
           </li>
           <li>
             <a href="#!">Link 4</a>
           </li>
         </ul>
 
       </div>
       <!-- Grid column -->
 
       <hr class="clearfix w-100 d-md-none">
 
       <!-- Grid column -->
       <div class="col-md-2 mx-auto">
 
         <!-- Links -->
         <h5 class="font-weight-bold text-white text-uppercase mt-3 mb-4">Links</h5>
 
         <ul class="list-unstyled">
           <li>
             <a href="#!">Link 1</a>
           </li>
           <li>
             <a href="#!">Link 2</a>
           </li>
           <li>
             <a href="#!">Link 3</a>
           </li>
           <li>
             <a href="#!">Link 4</a>
           </li>
         </ul>
 
       </div>
       <!-- Grid column -->
 
     </div>
     <!-- Grid row -->
 
   </div>
   <!-- Footer Links -->
 
   <hr>
 
   <!-- Call to action -->
   <ul class="list-unstyled list-inline text-center py-2">
     <li class="list-inline-item">
       <h5 class="mb-1 text-white">Register for free</h5>
     </li>
     <li class="list-inline-item">
       <a href="#!" class="btn btn-danger btn-rounded">Sign up!</a>
     </li>
   </ul>
   <!-- Call to action -->
 
   <hr>
 
 
   <!-- Copyright -->
   <div class="footer-copyright text-white text-center py-3">&copy;2020-<span class="year"></span> Copyright:
     <a href="#" class="text-white"> Your Company Name</a>
   </div>
   <!-- Copyright -->
 
 </footer>
 <!-- Footer -->

<style>
.footer-upper-social-icon {
  background-color: black;
}
.footer-upper-social-icon .btn-floating{
  font-size: 1.3em;
}

.footer-upper-social-icon .footer-social-icon li{
  width: 40px;
  height: 40px;
  cursor: pointer;
  box-shadow: 0 1px 3px rgba(0,0,0,0.3);
  border-radius: 50%;
  position: relative;
  overflow: hidden;
  transition: top 0.3s;

}
.footer-upper-social-icon .footer-social-icon li a{
  position: absolute;;
  top: 45%;
  left: 40%;
  color: #ffffff;
  transition: 0.5s;
  display: inline-block;
  transform: translate(-45%,-40%);
}

.footer-upper-social-icon .footer-social-icon li.fa-facebook-1{
  background-color: #3b5998;
}
.footer-upper-social-icon .footer-social-icon li.fa-twitter-1{
  background-color: #00acee;
}
.footer-upper-social-icon .footer-social-icon li.fa-google-plus-g-1{
  background-color:#db4a39;
}
.footer-upper-social-icon .footer-social-icon li.fa-linkedin-in-1{
  background-color: #0e76a8;
}
.footer-upper-social-icon .footer-social-icon li.fa-dribbble-1{
  background-color: #ea4c89;
}
</style>  
<script type="text/javascript">
  $(function(){
    $(".footer-upper-social-icon .year").text(new Date().getFullYear());
  });
</script>

</div>
`,
});


Vvveb.Blocks.add("bootstrap4/footer-lower-social-icon", {
  name: t("Modern Footer with lower social icon"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/footer_lower_social_icon.png",
  html:`
 <div class="footer-lower-social-icon bg-dark">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4"><div class="block">
                        <div class="block-title"><strong>CONTACT INFO</strong></div>
                             <div class="block-content">
                                <ul class="contact-info">
                                    <li><strong>Address: </strong><span>  1234 Street Name, City, Country</span></li>
                                    <li><strong>Phone: </strong><span> (123) 456-7890</span></li>
                                    <li><strong>Email: </strong><span><a href="mailto:mail@example.com"> mail@example.com</a></span></li>
                                    <li><strong>Working Days/Hours: </strong><span> Mon - Sun / 9:00 AM - 8:00 PM</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 ">
                        <div class="block">
                            <div class="block-title"><strong>MY ACCOUNT</strong></div>
                            <div class="block-content">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <ul class="links">
                                            <li><a href="#" title="About Us">About Us</a></li>
                                            <li><a href="#" title="Contact Us">Contact Us</a></li>
                                            <li><a href="#" title="My Account">Term & Policy</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-xl-6">
                                        <ul class="links">
                                            <li><a href="#" title="Orders History">Write Link 1</a></li>
                                            <li><a href="#" title="Advanced Search">Write Link 2</a></li>
                                            <li><a href="#" title="Advanced Search">Write Link 3</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 ">
                        <div class="block">
                            <div class="block-title"><strong>FEATURES</strong></div>
                            <div class="block-content">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <ul class="links">
                                            <li><a href="#">Write Link 1</a></li>
                                            <li><a href="#">Write Link 2</a></li>
                                            <li><a href="#">Write Link 3</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-xl-6">
                                        <ul class="links">
                                            <li><a href="#">Write link 4</a></li>
                                            <li><a href="#">Write link 5</a></li>
                                            <li><a href="#">Write link 6</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
            <hr />
  <!-- Social buttons -->
  <ul class="list-unstyled list-inline text-center footer-social-icon">
    <li class="list-inline-item fa-facebook-f">
      <a class="btn-floating btn-fb mx-1">
        <i class="fab fa-facebook-f"> </i>
      </a>
    </li>
    <li class="list-inline-item  fa-twitter">
      <a class="btn-floating btn-tw mx-1">
        <i class="fab fa-twitter"> </i>
      </a>
    </li>
    <li class="list-inline-item fa-google-plus-g">
      <a class="btn-floating btn-gplus mx-1">
        <i class="fab fa-google-plus-g"> </i>
      </a>
    </li>
    <li class="list-inline-item fa-linkedin-in">
      <a class="btn-floating btn-li mx-1">
        <i class="fab fa-linkedin-in"> </i>
      </a>
    </li>
    <li class="list-inline-item fa-dribbble">
      <a class="btn-floating btn-dribbble mx-1">
        <i class="fab fa-dribbble"> </i>
      </a>
    </li>
  </ul>
  <!-- Social buttons -->

    <div class="footer-copyright text-center py-3">&copy;2020-<span class="year"></span> Copyright:
        <a href="#"> Your Company Name</a>
     </div>

<style type="text/css">
.footer-lower-social-icon{background-color:#121214;color:#777;padding:40px 0;font-size:13px}
.footer-lower-social-icon a{color:#fff}
.footer-lower-social-icon a:hover{color:#fff;text-decoration:underline}
.footer-lower-social-icon ul.links{padding:0;margin-top:-5px}
.footer-lower-social-icon ul.links li{position:relative;padding:10px 0;line-height:1;display:block}
.footer-lower-social-icon ul.links li i{margin-left:-5px}
.footer-lower-social-icon ul.features{padding:0;margin-top:-5px}
.footer-lower-social-icon ul.features li{position:relative;padding:10px 0;line-height:1;display:block}
.footer-lower-social-icon ul.features li i{margin-left:-5px;margin-right:3px}
.footer-lower-social-icon p{margin-bottom:15px;color:#777}
.footer-lower-social-icon p.label{display:block;text-align:left;font-size:13px;font-weight:400;padding:0}
.footer-lower-social-icon ul{padding:0}
.footer-lower-social-icon .block{text-align:left;line-height:1.5;border:0;margin:0;background-color:transparent;float:none;width:auto}
.footer-lower-social-icon .block .block-title{margin-bottom:20px}
.footer-lower-social-icon .block .block-title strong{font-weight:400;padding:0;font-size:16px;line-height:inherit;color:#bb3535;text-transform:none}
.footer-lower-social-icon .contact-info li{padding:5px 0}
.footer-lower-social-icon .contact-info li:first-child{padding-top:0}
.footer-lower-social-icon .contact-info p{display:inline-block;vertical-align:top;margin:0}
.footer-lower-social-icon .contact-info i{color:#777;display:inline-block;vertical-align:top;font-size:14px;line-height:18px}

.footer-lower-social-icon{
    background-color:#ffffff;
}
.footer-lower-social-icon, .footer-lower-social-icon p, .footer-lower-social-icon .contact-info i{
    color:#90969A;
}
.footer-lower-social-icon a{
    color:#90969A;
}
.footer-lower-social-icon a:hover{
    color:#ffffff;
    text-decoration: none;
    transition: 0.3s;
}
.footer-lower-social-icon .btn-floating{
    font-size: 1.3em;
}

.footer-lower-social-icon .footer-social-icon li{
    border:1px solid;
    width: 40px;
    height: 40px;
    cursor: pointer;
    box-shadow: 0 1px 3px rgba(0,0,0,0.3);
    border-radius: 50%;
    position: relative;
    overflow: hidden;
    transition: top 0.3s;

}
.footer-lower-social-icon .footer-social-icon li a{
    position: absolute;;
    top: 45%;
    left: 40%;
    transition: 0.5s;
    display: inline-block;
    transform: translate(-45%,-40%);
}


.footer-lower-social-icon .footer-social-icon li::before{
  content: "";
  display: inline-block;
  height: 100%;
  width: 100%;
  top: 100%;
  left: 0;
  background-color: blue;
  position: absolute;
  transition: 0.4s;
  overflow: hidden;
  border-radius: 50%;
}
.footer-lower-social-icon .footer-social-icon li.fa-facebook-f::before{
    background-color: #3b5998;
}
.footer-lower-social-icon .footer-social-icon li.fa-twitter::before{
    background-color: #00acee;
}
.footer-lower-social-icon .footer-social-icon li.fa-google-plus-g::before{
    background-color:#db4a39;
}
.footer-lower-social-icon .footer-social-icon li.fa-linkedin-in::before{
    background-color: #0e76a8;
}
.footer-lower-social-icon .footer-social-icon li.fa-dribbble::before{
    background-color: #ea4c89;
}
.footer-lower-social-icon .footer-social-icon li:hover:before{
    top: 0;
}
.footer-lower-social-icon .footer-social-icon li:hover a{
    color: #ffffff;
}
</style>
<script type="text/javascript">
  $(function(){
    $(".footer-lower-social-icon .year").text(new Date().getFullYear());
  });
</script>
</div>
`,
});

Vvveb.Blocks.add("bootstrap4/testimonial-two-column", {
  name: t("Testimonial with two column"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/testimonial2.png",
  html:`
<div class="testimonial-two-column">
  
  <div class="row container"  >
      <div class="col-sm-6" >
          <div class="row column-1">
              <div class="col-lg-3 text-center text-lg-left">
              <img src="https://source.unsplash.com/1000x1000/?person,doctor" width="100px" title="avatar" class="rounded-circle img-thumbnail mt-3" > 

              </div>
              <div class="col-lg-8 col-description p-2  text-center text-lg-left " >
                  <h3> Lorem Impusm </h3>
                  <h5>Profession</h5>
                  <a href="#" title="follow on instagram"><i class='fab fa-instagram'></i></a>
                  <a href="#" title="follow on twitter"><i class='fab fa-twitter'></i></a>
                  <a href="#" title="follow on Google+"><i class='fab fa-google-plus'></i></a>
                  <a href="#" title="follow on LinkedIn"><i class='fab fa-linkedin'></i></a>
                  <hr style="margin: 0;">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                  </p>
              </div>
          </div>   
      </div>
      <div class="col-sm-6">
           <div class="row column-2">
              <div class="col-lg-3  text-center text-lg-left">

              <img width="100px" src="https://source.unsplash.com/9UVmlIb0wJU/500x500" class="rounded-circle  img-thumbnail  mt-3" alt="...">
              </div>
              <div class="col-lg-8  p-2  col-description  text-center text-lg-left">
                  <h3> Lorem Impusm </h3>
                  <h5>Profession</h5>
                  <a href="#" title="follow on instagram"><i class='fab fa-instagram'></i></a>
                  <a href="#" title="follow on twitter"><i class='fab fa-twitter'></i></a>
                  <a href="#" title="follow on Google+"><i class='fab fa-google-plus'></i></a>
                  <a href="#" title="follow on LinkedIn"><i class='fab fa-linkedin'></i></a>
                  <hr style="margin: 0;">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                  </p>
              </div>
          </div>
      </div>
  </div>
      <div class="row container" >
      <div class="col-sm-6">
          <div class="row column-3">
              <div class="col-lg-3  text-center text-lg-left">

              <img class="rounded-circle  mt-3  img-thumbnail" src="https://source.unsplash.com/1000x1000/?person,user" width="100px" alt="avatar">

              </div>
              <div class="col-lg-8  p-2 col-description  text-center text-lg-left">
                  <h3> Lorem Impusm </h3>
                  <h5>Profession</h5>
                  <a href="#" title="follow on instagram"><i class='fab fa-instagram'></i></a>
                  <a href="#" title="follow on twitter"><i class='fab fa-twitter'></i></a>
                  <a href="#" title="follow on Google+"><i class='fab fa-google-plus'></i></a>
                  <a href="#" title="follow on LinkedIn"><i class='fab fa-linkedin'></i></a>
                  <hr style="margin: 0;">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                  </p>
              </div>
          </div>   
      </div>
      <div class="col-sm-6">
           <div class="row column-4">
              <div class="col-lg-3  text-center text-lg-left">

              <img width="100px" class="rounded-circle  mt-3 img-thumbnail"  src="https://source.unsplash.com/1000x1000/?person,engineer" alt="avatar">

              </div>
              <div class="col-lg-8  p-2 col-description  text-center text-lg-left">
                  <h3> Lorem Impusm </h3>
                  <h5>Profession</h5>
                  <a href="#" title="follow on instagram"><i class='fab fa-instagram'></i></a>
                  <a href="#" title="follow on twitter"><i class='fab fa-twitter'></i></a>
                  <a href="#" title="follow on Google+"><i class='fab fa-google-plus'></i></a>
                  <a href="#" title="follow on LinkedIn"><i class='fab fa-linkedin'></i></a>
                  <hr style="margin: 0;">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                  </p>
              </div>
          </div>
      </div>
  </div>
    <style type="text/css">
.testimonial-two-column  .col-sm-6 .row{
background-color:  #212146;
border:5px solid #ffffff;
border-radius:10px;
}
.testimonial-two-column .col-description{
font-size: 0.9em;
}
.testimonial-two-column .col-description h3{
color: #737070;
}
.testimonial-two-column .col-description h5{        
color: #94949c;
font-weight: bold;
}
.testimonial-two-column .col-description p{
color: #a9a9ec;
}
.testimonial-two-column .col-description a{
 margin-right: 3px;
 font-size: 16px;
}
.testimonial-two-column .col-description .fa-facebook{
 color:  #3b5998;
}
.testimonial-two-column .col-descriptoin .fa-facebook{
 color: #00acee;
}
 .testimonial-two-column .col-descriptoin .fa-linkedin{
 color: #0e76a8;
}
.testimonial-two-column .container{
 max-width: 1100px;
 margin: auto
}
</style>
</div>
`,
});



Vvveb.Blocks.add("bootstrap4/testimonial-one-column", {
  name: t("Testimonial with one column"),
dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
  image: "../../img/blocks/testimonial1.png",
  html:`
  <div class="testimonial-one-column mt-2 borderd ">
  <div  class="row container mx-auto row-1  mt-0">
      <div class="col-lg-3  p-3 text-center text-lg-left order-1">
          <img src="https://source.unsplash.com/9UVmlIb0wJU/500x500" class="img-thumbnail img-fluid rounded-circle d-block mx-auto" width="200px"  alt="image">

          <div class="font-weight-bolder text-center p-2">Lorem Ipsum</div>
      </div>
      <div class="col-lg-9 p-4 right-column order-2">
          
          <p class="text-center">
            <i class="fa fa-quote-left" aria-hidden="true"></i>&nbsp;
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum&nbsp;
            <i class="fa fa-quote-right" aria-hidden="true"></i>
        </p>

        <div class="rating text-center text-lg-left" >
              <i class="fas fa-3x fa-star"></i>
              <i class="fas fa-3x fa-star"></i>
              <i class="fas fa-3x fa-star"></i>
              <i class="fas fa-3x fa-star"></i>
              <i class="fas fa-3x fa-star"></i>
        </div>
      </div>
    </div>
  <hr />
  <div  class="row container testimonial-container-two mx-auto row-2 mt-4">
      <div class="col-lg-9 p-4 right-column order-2 order-lg-1">
            <p class="text-center">
            <i class="fa fa-quote-left" aria-hidden="true"></i>&nbsp;
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum&nbsp;
            <i class="fa fa-quote-right" aria-hidden="true"></i>

          </p>

        <div class="rating text-right">
              <i class="fas fa-3x fa-star checked"></i>
              <i class="fas fa-3x fa-star"></i>
              <i class="fas fa-3x fa-star"></i>
              <i class="fas fa-3x fa-star"></i>
              <i class="fas fa-3x fa-star"></i>
        </div>
      </div>
      <div class="col-lg-3 p-3 order-1 order-lg-2">
          <img src="https://source.unsplash.com/9UVmlIb0wJU/500x500" width="200px" class="d-block mx-auto img-thumbnail img-fluid rounded-circle" alt="image">
          <div class="font-weight-bolder text-center p-2">Lorem Ipsum</div>
      </div>
  </div>
<style>

.testimonial-one-column{
  font-family: sans-serif;
  margin: auto;
}
.testimonial-one-column .row-1{
    background-color: #171719;
    color: #fff;
    border-top-left-radius: 86px;
    border-bottom-right-radius: 90px;

}
.testimonial-one-column .row-2{
    background-color: #171719;
    color: #fff;
    border-top-right-radius: 86px;
    border-bottom-left-radius: 90px;
}

.testimonial-one-column .row,.container{
  margin: 0;
  padding: 0;
}
.testimonial-one-column .fa-quote-left,.fa-quote-right{
  color: blue;
  font-size: 2em;
}
.testimonial-one-column .rating i{
  font-size: 1.5em;
}
</style>  
</div>
`,
});





Vvveb.Blocks.add("bootstrap4/signin-split", {
    name: t("Modern Sign In page with split screen format"),
	dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',    
    image: "https://startbootstrap.com/assets/img/screenshots/snippets/sign-in-split.jpg",
    html: `
<div class="container-fluid">
  <div class="row no-gutter">
    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
    <div class="col-md-8 col-lg-6">
      <div class="login d-flex align-items-center py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-lg-8 mx-auto">
              <h3 class="login-heading mb-4">Welcome back!</h3>
              <form>
                <div class="form-label-group">
                  <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                  <label for="inputEmail">Email address</label>
                </div>

                <div class="form-label-group">
                  <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                  <label for="inputPassword">Password</label>
                </div>

                <div class="custom-control custom-checkbox mb-3">
                  <input type="checkbox" class="custom-control-input" id="customCheck1">
                  <label class="custom-control-label" for="customCheck1">Remember password</label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Sign in</button>
                <div class="text-center">
                  <a class="small" href="#">Forgot password?</a></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<style>
.login,
.image {
  min-height: 100vh;
}

.bg-image {
  background-image: url('https://source.unsplash.com/WEQbe2jBg40/600x1200');
  background-size: cover;
  background-position: center;
}

.login-heading {
  font-weight: 300;
}

.btn-login {
  font-size: 0.9rem;
  letter-spacing: 0.05rem;
  padding: 0.75rem 1rem;
  border-radius: 2rem;
}

.form-label-group {
  position: relative;
  margin-bottom: 1rem;
}

.form-label-group>input,
.form-label-group>label {
  padding: var(--input-padding-y) var(--input-padding-x);
  height: auto;
  border-radius: 2rem;
}

.form-label-group>label {
  position: absolute;
  top: 0;
  left: 0;
  display: block;
  width: 100%;
  margin-bottom: 0;
  line-height: 1.5;
  color: #495057;
  cursor: text;
  /* Match the input under the label */
  border: 1px solid transparent;
  border-radius: .25rem;
  transition: all .1s ease-in-out;
}

.form-label-group input::-webkit-input-placeholder {
  color: transparent;
}

.form-label-group input:-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-moz-placeholder {
  color: transparent;
}

.form-label-group input::placeholder {
  color: transparent;
}

.form-label-group input:not(:placeholder-shown) {
  padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
  padding-bottom: calc(var(--input-padding-y) / 3);
}

.form-label-group input:not(:placeholder-shown)~label {
  padding-top: calc(var(--input-padding-y) / 3);
  padding-bottom: calc(var(--input-padding-y) / 3);
  font-size: 12px;
  color: #777;
}
</style>  
</div>
`,
});    

Vvveb.Blocks.add("bootstrap4/image-gallery", {
    name: t("Image gallery"),
    image: "https://startbootstrap.com/assets/img/screenshots/snippets/thumbnail-gallery.jpg",
	dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',    
    html: `
<div class="container">

  <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Thumbnail Gallery</h1>

  <hr class="mt-2 mb-5">

  <div class="row text-center text-lg-left">

    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/pWkk7iiCoDM/400x300" alt="">
          </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/aob0ukAYfuI/400x300" alt="">
          </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/EUfxH-pze7s/400x300" alt="">
          </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/M185_qYH8vg/400x300" alt="">
          </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/sesveuG_rNo/400x300" alt="">
          </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/AvhMzHwiE_0/400x300" alt="">
          </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/2gYsZUmockw/400x300" alt="">
          </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/EMSDtjVHdQ8/400x300" alt="">
          </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/8mUEy0ABdNE/400x300" alt="">
          </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/G9Rfc1qccH4/400x300" alt="">
          </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/aJeH0KcFkuc/400x300" alt="">
          </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/p2TQ-3Bh3Oo/400x300" alt="">
          </a>
    </div>
  </div>

</div>
`,
});    

Vvveb.Blocks.add("bootstrap4/slider-header", {
    name: t("Image Slider Header"),
	dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/product.png">',        
    image: "https://startbootstrap.com/assets/img/screenshots/snippets/full-slider.jpg",
    html:`
<header class="slider">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <!-- Slide One - Set the background image for this slide in the line below -->
      <div class="carousel-item active" style="background-image: url('https://source.unsplash.com/LAaSoL0LrYs/1920x1080')">
        <div class="carousel-caption d-none d-md-block">
          <h2 class="display-4">First Slide</h2>
          <p class="lead">This is a description for the first slide.</p>
        </div>
      </div>
      <!-- Slide Two - Set the background image for this slide in the line below -->
      <div class="carousel-item" style="background-image: url('https://source.unsplash.com/bF2vsubyHcQ/1920x1080')">
        <div class="carousel-caption d-none d-md-block">
          <h2 class="display-4">Second Slide</h2>
          <p class="lead">This is a description for the second slide.</p>
        </div>
      </div>
      <!-- Slide Three - Set the background image for this slide in the line below -->
      <div class="carousel-item" style="background-image: url('https://source.unsplash.com/szFUQoyvrxM/1920x1080')">
        <div class="carousel-caption d-none d-md-block">
          <h2 class="display-4">Third Slide</h2>
          <p class="lead">This is a description for the third slide.</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
  </div>
    
<style>
.carousel-item {
  height: 100vh;
  min-height: 350px;
  background: no-repeat center center scroll;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
</style>  
</header>
`,
});


Vvveb.Blocks.add("bootstrap4/video-header", {
    name: t("Video Header"),
	dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/image.svg">',        
    image: "https://startbootstrap.com/assets/img/screenshots/snippets/video-header.jpg",
    html:`
<header class="video">
  <div class="overlay"></div>
  <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
    <source src="https://storage.googleapis.com/coverr-main/mp4/Mt_Baker.mp4" type="video/mp4">
  </video>
  <div class="container h-100">
    <div class="d-flex h-100 text-center align-items-center">
      <div class="w-100 text-white">
        <h1 class="display-3">Video Header</h1>
        <p class="lead mb-0">With HTML5 Video and Bootstrap 4</p>
      </div>
    </div>
  </div>
</header>

<section class="my-5">
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <p>The HTML5 video element uses an mp4 video as a source. Change the source video to add in your own background! The header text is vertically centered using flex utilities that are build into Bootstrap 4.</p>
      </div>
    </div>
  </div>
</section>
<style>
header.video {
  position: relative;
  background-color: black;
  height: 75vh;
  min-height: 25rem;
  width: 100%;
  overflow: hidden;
}

header.video video {
  position: absolute;
  top: 50%;
  left: 50%;
  min-width: 100%;
  min-height: 100%;
  width: auto;
  height: auto;
  z-index: 0;
  -ms-transform: translateX(-50%) translateY(-50%);
  -moz-transform: translateX(-50%) translateY(-50%);
  -webkit-transform: translateX(-50%) translateY(-50%);
  transform: translateX(-50%) translateY(-50%);
}

header.video .container {
  position: relative;
  z-index: 2;
}

header.video .overlay {
  /*position: absolute;*/
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background-color: black;
  opacity: 0.5;
  z-index: 1;
}

@media (pointer: coarse) and (hover: none) {
  header {
    background: url('https://source.unsplash.com/XT5OInaElMw/1600x900') black no-repeat center center scroll;
  }
  header video {
    display: none;
  }
}
</style>
`,
});



Vvveb.Blocks.add("bootstrap4/about-team", {
    name: t("About and Team Section"),
	dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/image.svg">',        
    image: "https://startbootstrap.com/assets/img/screenshots/snippets/about-team.jpg",
    html:`
<header class="bg-primary text-center py-5 mb-4">
  <div class="container">
    <h1 class="font-weight-light text-white">Meet the Team</h1>
  </div>
</header>

<div class="container">
  <div class="row">
    <!-- Team Member 1 -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-0 shadow">
        <img src="https://source.unsplash.com/TMgQMXoglsM/500x350" class="card-img-top" alt="...">
        <div class="card-body text-center">
          <h5 class="card-title mb-0">Team Member</h5>
          <div class="card-text text-black-50">Web Developer</div>
        </div>
      </div>
    </div>
    <!-- Team Member 2 -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-0 shadow">
        <img src="https://source.unsplash.com/9UVmlIb0wJU/500x350" class="card-img-top" alt="...">
        <div class="card-body text-center">
          <h5 class="card-title mb-0">Team Member</h5>
          <div class="card-text text-black-50">Web Developer</div>
        </div>
      </div>
    </div>
    <!-- Team Member 3 -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-0 shadow">
        <img src="https://source.unsplash.com/sNut2MqSmds/500x350" class="card-img-top" alt="...">
        <div class="card-body text-center">
          <h5 class="card-title mb-0">Team Member</h5>
          <div class="card-text text-black-50">Web Developer</div>
        </div>
      </div>
    </div>
    <!-- Team Member 4 -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-0 shadow">
        <img src="https://source.unsplash.com/ZI6p3i9SbVU/500x350" class="card-img-top" alt="...">
        <div class="card-body text-center">
          <h5 class="card-title mb-0">Team Member</h5>
          <div class="card-text text-black-50">Web Developer</div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.row -->

</div>
`,
});



Vvveb.Blocks.add("bootstrap4/portfolio-one-column", {
    name: t("One Column Portfolio Layout"),
	dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/image.svg">',        
    image: "https://startbootstrap.com/assets/img/screenshots/snippets/portfolio-one-column.jpg",
    html:`
    <div class="container">

      <!-- Page Heading -->
      <h1 class="my-4">Page Heading
        <small>Secondary Text</small>
      </h1>

      <!-- Project One -->
      <div class="row">
        <div class="col-md-7">
          <a href="#">
            <img class="img-fluid rounded mb-3 mb-md-0" src="http://placehold.it/700x300" alt="">
          </a>
        </div>
        <div class="col-md-5">
          <h3>Project One</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium veniam exercitationem expedita laborum at voluptate. Labore, voluptates totam at aut nemo deserunt rem magni pariatur quos perspiciatis atque eveniet unde.</p>
          <a class="btn btn-primary" href="#">View Project</a>
        </div>
      </div>
      <!-- /.row -->

      <hr>

      <!-- Project Two -->
      <div class="row">
        <div class="col-md-7">
          <a href="#">
            <img class="img-fluid rounded mb-3 mb-md-0" src="http://placehold.it/700x300" alt="">
          </a>
        </div>
        <div class="col-md-5">
          <h3>Project Two</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, odit velit cumque vero doloremque repellendus distinctio maiores rem expedita a nam vitae modi quidem similique ducimus! Velit, esse totam tempore.</p>
          <a class="btn btn-primary" href="#">View Project</a>
        </div>
      </div>
      <!-- /.row -->

      <hr>

      <!-- Project Three -->
      <div class="row">
        <div class="col-md-7">
          <a href="#">
            <img class="img-fluid rounded mb-3 mb-md-0" src="http://placehold.it/700x300" alt="">
          </a>
        </div>
        <div class="col-md-5">
          <h3>Project Three</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, temporibus, dolores, at, praesentium ut unde repudiandae voluptatum sit ab debitis suscipit fugiat natus velit excepturi amet commodi deleniti alias possimus!</p>
          <a class="btn btn-primary" href="#">View Project</a>
        </div>
      </div>
      <!-- /.row -->

      <hr>

      <!-- Project Four -->
      <div class="row">

        <div class="col-md-7">
          <a href="#">
            <img class="img-fluid rounded mb-3 mb-md-0" src="http://placehold.it/700x300" alt="">
          </a>
        </div>
        <div class="col-md-5">
          <h3>Project Four</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, quidem, consectetur, officia rem officiis illum aliquam perspiciatis aspernatur quod modi hic nemo qui soluta aut eius fugit quam in suscipit?</p>
          <a class="btn btn-primary" href="#">View Project</a>
        </div>
      </div>
      <!-- /.row -->

      <hr>

      <!-- Pagination -->
      <ul class="pagination justify-content-center">
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">1</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">2</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">3</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>

    </div>
`,
});



Vvveb.Blocks.add("bootstrap4/portfolio-two-column", {
    name: t("Two Column Portfolio Layout"),
	dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/image.svg">',        
    image: "https://startbootstrap.com/assets/img/screenshots/snippets/portfolio-one-column.jpg",
    html:`
<div class="container">

  <!-- Page Heading -->
  <h1 class="my-4">Page Heading
    <small>Secondary Text</small>
  </h1>

  <div class="row">
    <div class="col-lg-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project One</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
        </div>
      </div>
    </div>
    <div class="col-lg-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project Two</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit aliquam aperiam nulla perferendis dolor nobis numquam, rem expedita, aliquid optio, alias illum eaque. Non magni, voluptates quae, necessitatibus unde temporibus.</p>
        </div>
      </div>
    </div>
    <div class="col-lg-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project Three</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
        </div>
      </div>
    </div>
    <div class="col-lg-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project Four</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit aliquam aperiam nulla perferendis dolor nobis numquam, rem expedita, aliquid optio, alias illum eaque. Non magni, voluptates quae, necessitatibus unde temporibus.</p>
        </div>
      </div>
    </div>
    <div class="col-lg-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project Five</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
        </div>
      </div>
    </div>
    <div class="col-lg-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project Six</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit aliquam aperiam nulla perferendis dolor nobis numquam, rem expedita, aliquid optio, alias illum eaque. Non magni, voluptates quae, necessitatibus unde temporibus.</p>
        </div>
      </div>
    </div>
  </div>
  <!-- /.row -->

  <!-- Pagination -->
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#">1</a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#">2</a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#">3</a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
    </li>
  </ul>

</div>
`,
});

Vvveb.Blocks.add("bootstrap4/portfolio-three-column", {
    name: t("Three Column Portfolio Layout"),
	dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/image.svg">',        
    image: "https://startbootstrap.com/assets/img/screenshots/snippets/portfolio-three-column.jpg",
    html:`
<div class="container">

  <!-- Page Heading -->
  <h1 class="my-4">Page Heading
    <small>Secondary Text</small>
  </h1>

  <div class="row">
    <div class="col-lg-4 col-sm-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project One</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur eum quasi sapiente nesciunt? Voluptatibus sit, repellat sequi itaque deserunt, dolores in, nesciunt, illum tempora ex quae? Nihil, dolorem!</p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project Two</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project Three</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos quisquam, error quod sed cumque, odio distinctio velit nostrum temporibus necessitatibus et facere atque iure perspiciatis mollitia recusandae vero vel quam!</p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project Four</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project Five</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-sm-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project Six</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque earum nostrum suscipit ducimus nihil provident, perferendis rem illo, voluptate atque, sit eius in voluptates, nemo repellat fugiat excepturi! Nemo, esse.</p>
        </div>
      </div>
    </div>
  </div>
  <!-- /.row -->

  <!-- Pagination -->
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#">1</a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#">2</a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#">3</a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
    </li>
  </ul>

</div>
`,
});


Vvveb.Blocks.add("bootstrap4/portfolio-four-column", {
    name: t("Four Column Portfolio Layout"),
	dragHtml: '<img src="' + Vvveb.baseUrl + 'icons/image.svg">',        
    image: "https://startbootstrap.com/assets/img/screenshots/snippets/portfolio-four-column.jpg",
    html:`
<div class="container">

  <!-- Page Heading -->
  <h1 class="my-4">Page Heading
    <small>Secondary Text</small>
  </h1>

  <div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project One</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur eum quasi sapiente nesciunt? Voluptatibus sit, repellat sequi itaque deserunt, dolores in, nesciunt, illum tempora ex quae? Nihil, dolorem!</p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project Two</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project Three</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos quisquam, error quod sed cumque, odio distinctio velit nostrum temporibus necessitatibus et facere atque iure perspiciatis mollitia recusandae vero vel quam!</p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project Four</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project Five</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project Six</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque earum nostrum suscipit ducimus nihil provident, perferendis rem illo, voluptate atque, sit eius in voluptates, nemo repellat fugiat excepturi! Nemo, esse.</p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project Seven</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#">Project Eight</a>
          </h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius adipisci dicta dignissimos neque animi ea, veritatis, provident hic consequatur ut esse! Commodi ea consequatur accusantium, beatae qui deserunt tenetur ipsa.</p>
        </div>
      </div>
    </div>
  </div>
  <!-- /.row -->

  <!-- Pagination -->
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#">1</a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#">2</a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#">3</a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
    </li>
  </ul>

</div>
`,
});

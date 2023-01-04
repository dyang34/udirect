/** Left Menu euni 수정 */
var openNav = function() {
    document.getElementById("Sidenav").style.width = "250px";
    document.getElementById("conts").style.marginLeft = "250px";
    document.getElementById("nav").style.marginLeft = "250px";
  }
  var closeNav = function() {
    document.getElementById("Sidenav").style.width = "0px";
    document.getElementById("conts").style.marginLeft= "0px";
    document.getElementById("nav").style.marginLeft= "0px";
  }
  
  // 우 더블 클릭 
  var prev_time = "";
  $(document).on('contextmenu','.list-area, .write-area', function(e){
      
      var time = new Date().getTime();
  
      if (prev_time!="" && ((time-prev_time)<300)) {
        if(document.getElementById("Sidenav").style.width=="0px") {
          openNav();
        } else {
          closeNav();
        }
  //        e.preventDefault();
         
      } else {
          prev_time = time;
      }
  
      return false;
  });
  
  //drop down menu
  $(function(){
      var Accordion = function(el, multiple) {
          this.el = el || {};
          this.multiple = multiple || false;
  
          // Variables
          var link = this.el.find('.link');
          // Eventos
          link.on('click', {el: this.el, multiple: this.multiple},this.dropdown)
      }
      Accordion.prototype.dropdown = function(e) {
          var $el = e.data.el;
              $this = $(this),
              $next = $this.next();
          // Desencadena evento de apertura en los elementos siguientes a la clase link = ul.submenu
          $next.slideToggle();
          // Agregar clase open a elemento padre del elemento con clase link = li
          $this.parent().toggleClass('open');		
          //Parametro inicial que permite ver 1 solo submenu abierto 
          if(!e.data.multiple){
              $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
          }    
      }
      // Elegir submenus multiples (true) submenus uno a la vez (false)
      var accordion = new Accordion($('#accordion'), false);
  });
  
  //** File upload js
  const $inputs = document.querySelectorAll('input[type="file"]')
  for (let i = 0; i < $inputs.length; i++) {
    const $input = $inputs[i]
    const $container = $input.parentNode
    const $fileName = $container.querySelector('[data-file-name]')
    
    $input.addEventListener('change', function () {
      const fileNameFullPath = $input.value
      const fileName = fileNameFullPath.replace(/^.*[\\\/]/, '')
      
      $fileName.innerHTML = fileName
    })
  }
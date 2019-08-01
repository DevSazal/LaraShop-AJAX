<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{ asset('front-end/css/core-style.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/style.css') }}">
  </head>
  <body>
    <div class="jumbotron text-center">
      <h1>AliExpress</h1>
      <p>{{$obj->pageModule->ogurl}}</p>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-sm-5">
          <img src="{{$obj->pageModule->imagePath}}" class="mx-auto d-block">
        </div>
        <div class="col-sm-7">
          <h6>{{$obj->titleModule->subject}}</h6>
          <h3 style="color:#007bff" id="price">{{$obj->priceModule->minActivityAmount->value}} - {{$obj->priceModule->maxActivityAmount->value}} USD</h3>
          <p style="font-weight:bold">Color:</p>

          @foreach($obj->skuModule->productSKUPropertyList[0]->skuPropertyValues as $color)
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="color" value="{{$color->propertyValueDisplayName}}" >{{$color->propertyValueDisplayName}}
            </label>
          </div>
          @endforeach


        <br><p style="font-weight:bold">Type:</p>
        @foreach($obj->skuModule->productSKUPropertyList[2]->skuPropertyValues as $property)
        <div class="form-check-inline">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" id="type" name="type" value="{{$property->propertyValueId}}" onclick="typeSelect()">{{$property->propertyValueDefinitionName}}
          </label>
        </div>
        @endforeach


        </div>
      </div>
    </div>



    <script src="{{ asset('front-end/js/jquery/jquery-2.2.4.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('front-end/js/popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('front-end/js/bootstrap.min.js') }}"></script>
    <!-- Plugins js -->
    <script src="{{ asset('front-end/js/plugins.js') }}"></script>
    <!-- Classy Nav js -->
    <script src="{{ asset('front-end/js/classy-nav.min.js') }}"></script>
    <!-- Active js -->
    <script src="{{ asset('front-end/js/active.js') }}"></script>
    <script type="text/javascript">

    function typeSelect() {

        var types = document.getElementsByName("type");
        for (index = 0; index < types.length; ++index) {
            console.log(types[index]);
            if(types[index].checked){
              // alert(types[index].value);
              // document.getElementById("price").innerHTML = "$" + types[index].value + " USD<br>";
              var ppid = types[index].value;
              $.ajax({
                type: 'get',
                url: '/get-json-item-price',
                data: {ppid:ppid},
                success:function(response){
                  // alert(res);
                  document.getElementById("price").innerHTML = "$" + response + " USD<br>";
                },
                error: function(){
                  alert("Error");
                }
              })
              break;
            }
        }

    }

    </script>
  </body>
</html>

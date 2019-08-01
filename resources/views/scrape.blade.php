@extends('layouts.main')
@section('title', 'Shop - ')

@section('content')

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                      <div class="search-area">
                          <form class="form-inline">
                              @csrf
                              <div class="form-group mx-sm-3 mb-2">

                                <input type="search" class="form-control" name="search" id="scraper" placeholder="Type Link" autocomplete="off">
                              </div>
                              <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search" aria-hidden="true"></i> GET</button>
                              <input type="hidden" name="_cat" value="1">
                          </form>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="">

                      <div class="widget mb-50">
                        <!-- <div class="search-area">
                            <form>
                                <input type="search" name="search" id="scraper" placeholder="Type for live search" autocomplete="off">
                                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                <input type="hidden" name="_cat" value="1">

                                @csrf
                            </form>
                        </div> -->

                      </div>

                        <!-- ##### Single Widget ##### -->


                        <!-- ##### Single Widget ##### -->


                        <!-- ##### Single Widget ##### -->


                        <!-- ##### Single Widget ##### -->

                    </div>
                </div>


            </div>
        </div>
    </section>
    <!-- ##### Shop Grid Area End ##### -->

@endsection

@section('script')
<script>
  $(document).ready(function(){
    fetch_search_data();
    function fetch_search_data(query = ''){
      var _cat = $('input[name="_cat"]').val();
      $.ajax({
        url: "{{ route('LiveSearch.action') }}",
        methed: 'GET',
        data: {query:query, cat:_cat},
        dataType: 'json',
        success: function(data){
          $('#fetchDataList').html(data.total_data);
        }
      })
    }

      $(document).on('keyup', '#psearch', function(){
      var query = $(this).val();
      fetch_search_data(query);
     });
  });
</script>
@endsection

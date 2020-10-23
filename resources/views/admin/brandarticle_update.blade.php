@extends('admin.layouts.admin_app')
@section('title')品牌名称更新列表@stop
@section('head')
    <style>.red{color: red;}</style>
@stop
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">文档列表管理 文档总计{{$articles->total()}}</h3>
                    <div class="box-tools">
                        <div class="pull-right" style="display:inline-block; width: 210px">
                            <a href="{{action('Admin\ArticleController@Create')}}" style="color: #ffffff ; display: inline-block; padding-left: 3px;"><button  class="btn btn-sm btn-default bg-blue"><i class="fa  fa-pencil-square" style="padding-right: 3px;"></i>添加文档</button></a>
                            <a href="{{action('Admin\ArticleController@BrandCreate')}}" style="color: #ffffff; display: inline-block; padding-left: 3px;"><button  class="btn btn-sm btn-default bg-purple"><i class="fa  fa-pencil-square-o" style="padding-right: 3px;"></i>添加品牌文档</button></a>
                        </div>
                        <form action="/admin/brand_search" method="post" class="form-group pull-right col-md-2 col-xs-6">
                            <div class="input-group input-group-sm ">
                                <input type="text" name="title" class="form-control pull-right" placeholder="品牌搜索">
                                {{csrf_field()}}
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>文章标题</th>
                            <th>栏目</th>
                            <th>发布者</th>
                            <th>品牌名称</th>
                            <th>操作</th>
                        </tr>
                        @foreach($articles as $article)
                            <tr>
                                <td>{{$article->id}}</td>
                                <td>@if($article->ismake) <a target="_blank" href="/xiangmu/{{$article->id}}.html" style="color: #333">{{$article->brandname}}</a> @else <a  target="_blank" style="color: red;" href="/xiangmu/{{$article->id}}.html"><s class="red"> {{$article->brandname}}</s></a> @endif @if($article->mid) <span class="fa fa-flag red"></span> @endif</td>
                                <td>{{$article->arctype->typename}}</td>
                                <td>{{$article->write}}</td>
                                <td id="td{{$article->id}}">@if($article->status==1) {{$article->title}} @else<input type="text"  class="form-control pull-right" value="{{$article->title}}" id="input{{$article->id}}"/>@endif </td>
                                <td>@if($article->status==1)
                                        <span class="label label-success" style=" font-weight: normal; line-height: 30px;">已修改</span>
                                    @else
                                        <span class="label label-danger" style="cursor: pointer; font-weight: normal; line-height: 30px;"  id="status{{$article->id}}" onclick="statuschick('status{{$article->id}}',{{$article->id}})">修改品牌名称</span>
                                    @endif</td>
                        @endforeach
                    </table>
                    {!! $articles->links() !!}

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    <!-- /.content -->
@stop

@section('libs')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
        });
        function statuschick(element,id) {
            var brandname=$("#input"+id).val();
            $.ajax({
                //提交数据的类型 POST GET
                type:"POST",
                //提交的网址
                url:"/admin/brandnamestatus/",
                //提交的数据
                data:{"id":id,"title":brandname},
                //返回数据的格式
                datatype: "html",    //"xml", "html", "script", "json", "jsonp", "text".
                success:function (response, stutas, xhr) {
                    //$(".modal-s-m"+id+" .modal-body").html(response);
                    console.log('#'+element)
                    $('#'+element).text(response);
                    $('#'+element).removeClass( "bg-red" );
                    $('#'+element).text('已修改');
                    $('#td'+id).html(brandname);
                    $('#'+element).addClass( "bg-green" );

                }
            });
        }
    </script>
@stop



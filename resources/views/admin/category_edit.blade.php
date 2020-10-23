@extends('admin.layouts.admin_app')
@section('title')  网站栏目管理_更改栏目 @stop
@section('head')
    <link href="/adminlte/plugins/iCheck/all.css" rel="stylesheet">
    <link href="/adminlte/plugins/iCheck/all.css" rel="stylesheet">
    <link href="/adminlte/plugins/bootstrap-fileinput/css/fileinput.min.css" rel="stylesheet">
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#settings" data-toggle="tab">常规选项</a></li>
                </ul>
                {{Form::model($typeinfos,array('route' => array('category_edit','id'=>$id),'method' => 'put','files' => true,'class'=>"form-horizontal"))}}
                <div class="tab-content">
                    <div class="active tab-pane" id="settings">
                        <div style="margin-bottom: 15px;"></div>

                        <div class="form-group">
                            {{Form::label('typename', '栏目名称', array('class' => 'col-sm-2 control-label'))}}
                            <div class="col-sm-5">
                                {{Form::text('typename', null, array('class' => 'form-control','id'=>'typename','placeholder'=>'栏目名称'))}}
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('typedir', '栏目路径', array('class' => 'col-sm-2 control-label'))}}
                            <div class="col-sm-5">
                                {{Form::text('typedir', null, array('class' => 'form-control','id'=>'typedir','placeholder'=>'栏目路径'))}}
                            </div>
                        </div>
                        @if($reid!=0)
                            <div class="form-group">
                                {{Form::label('selectd', '父级栏目', array('class' => 'col-sm-2 control-label'))}}
                                <div class="col-sm-5">
                                    {{Form::select('reid', $allnavinfos, "$thisnavinfos->reid",array('class'=>'form-control select2','style'=>'width: 100%'))}}
                                </div>
                            </div>
                        @endif
                        <div class="form-group  ">
                            {{Form::label('dirposition', '目录相对位置', array('class' => 'col-sm-2 control-label'))}}
                            <div class="col-sm-5 basic_info">
                                @if($typeinfos->dirposition ==1)
                                {{Form::radio('dirposition', '1', true,array('class'=>"flat-red",'checked'=>'checked'))}} 站点根目录
                                {{Form::radio('dirposition', '0',false,array('class'=>"flat-red"))}} 上级目录
                                @else
                                    {{Form::radio('dirposition', '1', true,array('class'=>"flat-red"))}} 站点根目录
                                    {{Form::radio('dirposition', '0',false,array('class'=>"flat-red",'checked'=>'checked'))}} 上级目录
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('sortrank', '栏目排序', array('class' => 'col-sm-2 control-label'))}}
                            <div class="col-sm-5">
                                {{Form::text('sortrank',null, array('class' => 'form-control','id'=>'sortrank','placeholder'=>'栏目排序'))}}
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('description', '栏目描述', array('class' => 'col-sm-2 control-label'))}}
                            <div class="col-sm-5">
                                {{Form::textarea('description', null, array('class' => 'form-control','id'=>'description','placeholder'=>'栏目描述','cols'=>'','rows'=>''))}}

                            </div>
                        </div>
                        <div class="form-group  ">
                            {{Form::label('mid', '栏目类型', array('class' => 'col-sm-2 control-label'))}}
                            <div class="col-sm-5 basic_info">
                                @if($typeinfos->mid==1)
                                    {{Form::radio('mid', '1', true,array('class'=>"flat-red",'checked'=>'checked'))}} 品牌类型
                                    {{Form::radio('mid', '0',false,array('class'=>"flat-red"))}} 普通文章
                                @else
                                    {{Form::radio('mid', '1', true,array('class'=>"flat-red"))}} 品牌类型
                                    {{Form::radio('mid', '0',false,array('class'=>"flat-red",'checked'=>'checked'))}} 普通文章
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('title', '栏目标题', array('class' => 'col-sm-2 control-label'))}}
                            <div class="col-sm-5">
                                {{Form::text('title', null, array('class' => 'form-control','id'=>'title','placeholder'=>'栏目标题'))}}
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('keywords', '栏目关键字', array('class' => 'col-sm-2 control-label'))}}
                            <div class="col-sm-5">
                                {{Form::text('keywords', null, array('class' => 'form-control','id'=>'keywords','placeholder'=>'栏目关键字'))}}
                            </div>
                        </div>

                        <div class="form-group  ">
                            {{Form::label('is_write', '是否允许发布文档', array('class' => 'col-sm-2 control-label'))}}
                            <div class="col-sm-5 basic_info">
                                @if($typeinfos->is_write)
                                {{Form::radio('is_write', '1', true,array('class'=>"flat-red",'checked'=>'checked'))}} 允许
                                {{Form::radio('is_write', '0',false,array('class'=>"flat-red"))}} 不允许
                                @else
                                {{Form::radio('is_write', '1', true,array('class'=>"flat-red"))}} 允许
                                {{Form::radio('is_write', '0',false,array('class'=>"flat-red",'checked'=>'checked'))}} 不允许
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- /.tab-pane -->
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            {{Form:: button('提交',array('class'=>'btn btn-danger','type'=>'submit'))}}
                        </div>
                    </div>
            {!! Form::close() !!}
            <!-- /.tab-content -->

            </div>
            <!-- /.nav-tabs-custom -->
            @if(count($errors) > 0)
                <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@stop

@section('libs')
    <!-- iCheck -->
    <script src="/adminlte/plugins/iCheck/icheck.min.js"></script>
    <script src="/adminlte/plugins/bootstrap-fileinput/js/fileinput.min.js"></script>
    <script src="/adminlte/plugins/bootstrap-fileinput/js/locales/zh.js"></script>
    <script>
        $(function () {
            //iCheck for checkbox and radio inputs
            $('.basic_info input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
            //Red color scheme for iCheck
            $('.basic_info input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass: 'iradio_minimal-red'
            });
            //Flat red color scheme for iCheck
            $('.basic_info input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

        });
    </script>
@stop


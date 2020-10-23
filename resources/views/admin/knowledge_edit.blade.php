@extends('admin.layouts.admin_app')
@section('title')编辑知识文档文档@stop
@section('head')
    <link href="/adminlte/plugins/iCheck/all.css" rel="stylesheet">
    <link rel="stylesheet" href="/adminlte/plugins/datepicker/datepicker3.css">
    <link href="/adminlte/plugins/bootstrap-fileinput/css/fileinput.min.css" rel="stylesheet">
    <link href="/adminlte/plugins/select2/select2.min.css" rel="stylesheet">
    <style>
        .select2-container--default .select2-selection--single {
            border-radius: 0px;
        }
        .select2-container .select2-selection--single {
            height: 34px;
            border: 1px solid #d2d6de;
        }
        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-left: 0px;
        }
    </style>
@stop
@section('content')
    <!-- row -->
    <div class="row">
        {{Form::model($articleinfos,array('route' =>array( 'knowlede_edit','id'=>$id),'method' => 'put','files' => true,'id'=>"formarticle"))}}
        <div class="col-md-12">
            <!-- The time line -->
            <ul class="timeline">

                <!-- timeline time label -->
                <li class="time-label">
                  <span class="bg-red">
                     {{date("M j, Y")}}
                  </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->

                <li>
                    <i class="fa fa-pencil-square bg-blue"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{date('H:i')}}{{$articleinfos->created_at}}</span>

                        <h3 class="timeline-header"><a href="#">文章基本信息|</a> 按需填写</h3>

                        <div class="timeline-body basic_info">
                            <div class="form-group col-md-12">
                                {{Form::label('title', '文章标题', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                <div class="col-md-4 col-sm-9 col-xs-12">
                                    {{Form::text('title', null, array('class' => 'form-control','id'=>'title','placeholder'=>'文章标题'))}}
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">自定义文档属性</label>
                                <div class="checkbox" style="margin-top: 0px;">
                                    <label>
                                        @if(strpos($articleinfos->flags, 'h') !== false)
                                            {{Form::checkbox('flags[]', 'h',true,array('class'=>'flat-red'))}} 头条
                                        @else
                                            {{Form::checkbox('flags[]', 'h',false,array('class'=>'flat-red'))}} 头条
                                        @endif
                                    </label>
                                    <label>
                                        @if(strpos($articleinfos->flags, 'p') !== false)
                                            {{Form::checkbox('flags[]', 'p',true,array('class'=>'flat-red'))}} 图片
                                        @else
                                            {{Form::checkbox('flags[]', 'p',false,array('class'=>'flat-red'))}} 图片
                                        @endif
                                    </label>
                                    <label>
                                        @if(strpos($articleinfos->flags, 'c') !== false)
                                            {{Form::checkbox('flags[]', 'c',true,array('class'=>'flat-red'))}}  推荐
                                        @else
                                            {{Form::checkbox('flags[]', 'c',false,array('class'=>'flat-red'))}}  推荐
                                        @endif

                                    </label>
                                    <label>
                                        @if(strpos($articleinfos->flags, 'f') !== false)
                                            {{Form::checkbox('flags[]', 'f',true,array('class'=>'flat-red'))}}  幻灯
                                        @else
                                            {{Form::checkbox('flags[]', 'f',false,array('class'=>'flat-red'))}}  幻灯
                                        @endif
                                    </label>
                                    <label>
                                        @if(strpos($articleinfos->flags, 's') !== false)
                                            {{Form::checkbox('flags[]', 's',true,array('class'=>'flat-red'))}}  滚动
                                        @else
                                            {{Form::checkbox('flags[]', 's',false,array('class'=>'flat-red'))}}  滚动
                                        @endif
                                    </label>
                                    <label>
                                        @if(strpos($articleinfos->flags, 'a') !== false)
                                            {{Form::checkbox('flags[]', 'a',true,array('class'=>'flat-red'))}}  特荐
                                        @else
                                            {{Form::checkbox('flags[]', 'a',false,array('class'=>'flat-red'))}}  特荐
                                        @endif
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                {{Form::label('keywords', '文档关键字', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                <div class="col-md-4 col-sm-9 col-xs-12">
                                    {{Form::text('keywords',null, array('class' => 'form-control','id'=>'keywords','placeholder'=>'文档关键词'))}}
                                </div>
                            </div>
                            @if($articleinfos->brandid && isset($thisarticlebrandinfos->id))
                                <div class="form-group col-md-12">
                                    {{Form::label('brandcid', '品牌所属大类', array('class' => 'col-sm-2 control-label'))}}
                                    <div class="col-md-4">
                                        {{Form::select('brandcid', $brandnavs, null,array('class'=>'form-control select2' ,'id'=>'brandcid'))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-12 ">
                                    {{Form::label('brandtypeid', '品牌所属子类', array('class' => 'col-sm-2 control-label'))}}
                                    <div class="col-md-4">
                                        {{Form::select('brandtypeid', [], null,array('class'=>'form-control select2','id'=>'brandtypeid'))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    {{Form::label('brandid', '文档所属品牌', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-4 col-sm-9 col-xs-12">
                                        {{Form::select('brandid', [], null,array('class'=>'form-control select2','id'=>'brandid'))}}
                                    </div>
                                </div>
                            @else
                                <div class="form-group col-md-12">
                                    {{Form::label('brandcid', '品牌所属大类', array('class' => 'col-sm-2 control-label'))}}
                                    <div class="col-md-4">
                                        {{Form::select('brandcid', $brandnavs, null,array('class'=>'form-control select2' ,'id'=>'brandcid'))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-12 ">
                                    {{Form::label('typeid', '品牌所属子类', array('class' => 'col-sm-2 control-label'))}}
                                    <div class="col-md-4">
                                        {{Form::select('typeid', [], null,array('class'=>'form-control select2' ,'id'=>'brandtypeid'))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    {{Form::label('brandid', '文档所属品牌', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-4 col-sm-9 col-xs-12">
                                        {{Form::select('brandid', [], null,array('class'=>'form-control select2','id'=>'brandid'))}}
                                    </div>
                                </div>
                            @endif
                            <div class="form-group col-md-12">
                                {{Form::label('bdname', '所属品牌', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                <div class="col-md-4 col-sm-9 col-xs-12">
                                    {{Form::text('bdname',null, array('class' => 'form-control','id'=>'bdname','placeholder'=>'所属品牌名称'))}}
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                {{Form::label('description', '文档描述', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                <div class="col-md-4 col-sm-9 col-xs-12">
                                    {{Form::textarea('description',null, array('class' => 'form-control col-md-10','id'=>'desrciption','rows'=>3,'placeholder'=>'不填写将自动提取首段'))}}
                                </div>
                            </div>
                            @if(!$articleinfos->ismake || $articleinfos->published_at > \Carbon\Carbon::now())
                                <div class="form-group col-md-12 ">
                                    {{Form::label('ismake', '文章状态', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="radio col-md-4 col-sm-9 col-xs-12">
                                        @if($articleinfos->ismake)
                                            {{Form::radio('ismake', '1', true,array('class'=>'flat-red','checked'=>'checked'))}} 已审核
                                            {{Form::radio('ismake', '0', false,array('class'=>'flat-red'))}}未审核
                                        @else
                                            {{Form::radio('ismake', '1', true,array('class'=>'flat-red'))}} 已审核
                                            {{Form::radio('ismake', '0', false,array('class'=>'flat-red','checked'=>'checked'))}}未审核
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-12 ">
                                    {{Form::label('published_at', '预选发布时间', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="input-group date  col-md-4 " style="padding-right: 15px; padding-left: 15px;">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        {{Form::text('published_at', null, array('class' => 'form-control pull-right','id'=>'datepicker','placeholder'=>'点击选择时间',"autocomplete"=>"off"))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-12 has-warning">
                                    {{Form::label('xiongzhang', '资源提交', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="radio col-md-4 col-sm-9 col-xs-12">
                                        @if($articleinfos->xiongzhang==1)
                                            {{Form::radio('xiongzhang', '1', true,array('class'=>'flat-red','checked'=>'checked'))}} 快速收录
                                            {{Form::radio('xiongzhang', '2', false,array('class'=>'flat-red'))}}普通收录
                                        @else
                                            {{Form::radio('xiongzhang', '1', true,array('class'=>'flat-red'))}} 快速收录
                                            {{Form::radio('xiongzhang', '2', false,array('class'=>'flat-red','checked'=>'checked'))}}普通收录
                                        @endif
                                        <span class="help-block" ><i class="fa fa-bell-o"></i>  快速收录工具可以向百度搜索主动推送资源，缩短爬虫发现网站链接的时间，对于高实效性内容推荐使用快速收录工具，实时向搜索推送资源。普通收录接口，每天可提交最多500万条有价值内容。提交的内容会进入百度搜索统一管理，请耐心等待。</span>
                                    </div>
                                </div>
                            @else
                                {{Form::hidden('ismake',1 , array('class' => 'form-control col-md-10','id'=>'ismake'))}}
                            @endif
                        </div>
                        <div class="timeline-footer" style="clear: both"></div>
                    </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline item -->
                <li>
                    <i class="fa fa-photo bg-aqua"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{date('D M j')}}</span>
                        <h3 class="timeline-header no-border"><a href="#">缩略图处理</a> 图片上传</h3>
                        <div class="timeline-body">
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <img src="{{ $articleinfos->litpic }}" class="img-rounded img-responsive"/>
                            </div>
                            <div class="col-md-8 col-sm-12 col-xs-12">
                                {{Form::file('image', array('class' => 'file col-md-10','id'=>'input-2','data-show-upload'=>"false",'data-show-caption'=>"true",'accept'=>'image/*'))}}
                                {{Form::hidden('litpic',null , array('class' => 'form-control col-md-10','id'=>'litpic'))}}
                            </div>
                            <div style="clear: both"></div>

                        </div>
                    </div>
                </li>
                <li>
                    <i class="fa fa-file-text bg-maroon"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{date('H:m:s')}}</span>
                        <h3 class="timeline-header"><a href="#">文档处理</a>文章内容编辑</h3>
                        <div class="timeline-body">
                        @include('admin.layouts.ueditor')
                        <!-- 编辑器容器 -->
                            <script id="container" name="body" type="text/plain" > {!! $articleinfos->body!!}</script>
                        </div>
                        <div class="timeline-footer">
                            <button type="submit"  class="btn btn-md bg-maroon">提交文档</button>
                        </div>
                    </div>
                </li>
                <!-- END timeline item -->
                <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>
        </div>
        <!-- /.col -->
        {!! Form::close() !!}
    </div>
    @if(count($errors) > 0)
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
        </section>

@stop
@section('libs')
    <!-- iCheck -->
    <script src="/adminlte/plugins/iCheck/icheck.min.js"></script>
    <script src="/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="/adminlte/plugins/datepicker/locales/bootstrap-datepicker.zh-CN.js"></script>
    <script src="/adminlte/plugins/bootstrap-fileinput/js/fileinput.min.js"></script>
    <script src="/adminlte/plugins/bootstrap-fileinput/js/locales/zh.js"></script>
    <script src="/adminlte/plugins/select2/select2.full.min.js"></script>
    <script src="/adminlte/plugins/select2/i18n/zh-CN.js"></script>
    <script src="/adminlte/validator.js"></script>
    <script>
        $(function () {
            $('.select2').select2({language: "zh-CN"});
            $("#brandcid").select2().val({{$articleinfos->arctype->reid}}).trigger("change");
            getThissonTypes("/admin/getsontypes",{"reid":$("#brandcid").select2("val")},"#brandtypeid");
            $("#brandcid").on("change",function(){;getsonTypes("/admin/getsontypes",{"reid":$("#brandcid").select2("val")},"#brandtypeid")});
            $("#brandtypeid").on("change",function(){getBdname('/admin/getbdname',{"typeid":$("#brandtypeid").select2("val")},"#brandid")});
            $('#datepicker').datepicker({autoclose: true,language: 'zh-CN',todayHighlight: true });
            $('.basic_info input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({ checkboxClass: 'icheckbox_flat-green', radioClass: 'iradio_flat-green'});
        });
        $("#formarticle").submit(function () {
            $("#submitbutton").attr('disabled','disabled');
            $("#submitbutton").html('发布中 请稍后');
        });
    </script>
    <script>
        $("#input-image-1").fileinput({
            theme: 'fa',
            uploadUrl: "/admin/upload/images",
            allowedFileExtensions: ["jpg", "png", "gif",'jpeg'],
            maxImageWidth: 1000,
            minFileCount: 1,
            maxFileCount: 6,
            language: 'zh',
            overwriteInitial: false,
            resizeImage: true,
            initialPreviewAsData: true,
            initialPreview: [
                @foreach($pics as $pic)
                    "{{$pic}}",
                @endforeach
            ],
            initialPreviewConfig: [
                    @foreach($pics as $indexnum=>$pic)
                {caption: "{{$indexnum+1}}", url: "/admin/file-delete-batch", key: ['{{$pic}}']},
                @endforeach
            ],
            purifyHtml: true, // this by default purifies HTML data for preview
        }).on('fileuploaded', function(e, params) {
            $('#kv-success-box').html('上传成功！');
            $('#kv-success-modal').modal('show');
            $('.kv-file-remove').hide();
            $("#imagepics").val($("#imagepics").val()+','+params.response.link+',');
            $("#imagepics").val($("#imagepics").val().replace(',,',','));
        }).on("filepredelete", function() {
            var abort = true;
            if (confirm("确定要删除此图片吗 此删除操作为异步操作,删除后图片不可恢复,删除后请及时提交")) {
                abort = false;
            }
            return abort;
        }).on('filedeleted', function(event, key) {
            $("#imagepics").val($("#imagepics").val().replace(key,''));
            $("#imagepics").val($("#imagepics").val().replace(',,',','));
        });
        function getThissonTypes(url,datas,element)
        {
            $.ajax(
                {type:"POST",url:url,data:datas,
                    datatype: "json",
                    success:function (response) {
                        var contents='';
                        for (type in response) {
                            contents += '<option value="' + type + '">' + response[type] + '</option>';
                        }
                        $(element).html(contents);
                        $(element).select2().val({{$articleinfos->typeid}}).trigger("change");
                    }
                });
        }
        function getsonTypes(url,datas,element)
        {
            $.ajax(
                {type:"POST",url:url,data:datas,
                    datatype: "json",
                    success:function (response) {
                        var contents='';
                        for (type in response) {
                            contents += '<option value="' + type + '">' + response[type] + '</option>';
                        }
                        $(element).html(contents);
                        getBdname('/admin/getbdname',{"typeid":$("#brandtypeid").select2("val")},"#brandid")
                    }
                });
        }
        function getBdname(url,datas,element)
        {
            $.ajax(
                {type:"POST",url:url,data:datas,
                    datatype: "json",
                    success:function (response) {
                        var contents='';
                        for (type in response) {
                            contents += '<option value="' + type + '">' + response[type] + '</option>';
                        }
                        $(element).html(contents);
                        var val=$(element).select2("val")
                        $(element).select2().val({{$articleinfos->brandid}}).trigger("change");
                    }
                });
        }
    </script>
@stop


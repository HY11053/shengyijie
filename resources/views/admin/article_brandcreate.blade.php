@extends('admin.layouts.admin_app')
@section('title')添加品牌文档@stop
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
        {{Form::open(array('route' => 'article_brand_create','files' => true,'id'=>"formarticle"))}}
        <div class="col-md-12">
            <ul class="timeline">
                <li class="time-label">
                  <span class="bg-red">
                     {{date("M j, Y")}}
                  </span>
                </li>
                <li>
                    <i class="fa fa-pencil-square bg-blue"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{date('H:i')}}</span>
                        <h3 class="timeline-header"><a href="#">文章基本信息|</a> 按需填写</h3>
                        <div class="timeline-body basic_info">
                            <div class="form-group col-md-12" id="checktitle">
                                {{Form::label('title', '文章标题', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                <div class="col-md-4 col-sm-9 col-xs-12 ">
                                    {{Form::text('title', null, array('class' => 'form-control','id'=>'title','placeholder'=>'文章标题', 'autocomplete'=>"off",'required'=>'required'))}}
                                    <span class="help-block" style="display: none;"><i class="fa fa-bell-o"></i><em>标题已存在,请勿提交重复标题</em></span>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">自定义文档属性</label>
                                <div class="checkbox" style="margin-top: 0px;">
                                    <label>
                                        {{Form::checkbox('flags[]', 'h',false,array('class'=>'flat-red'))}} 头条
                                    </label>
                                    <label>
                                        {{Form::checkbox('flags[]', 'p',false,array('class'=>'flat-red'))}} 图片
                                    </label>
                                    <label>
                                        {{Form::checkbox('flags[]', 'c',false,array('class'=>'flat-red'))}} 推荐
                                    </label>
                                    <label>
                                        {{Form::checkbox('flags[]', 'f',false,array('class'=>'flat-red'))}} 幻灯
                                    </label>
                                    <label>
                                        {{Form::checkbox('flags[]', 's',false,array('class'=>'flat-red'))}} 滚动
                                    </label>
                                    <label>
                                        {{Form::checkbox('flags[]', 'a',false,array('class'=>'flat-red'))}} 特荐
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                {{Form::label('keywords', '关键字', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                <div class="col-md-4 col-sm-9 col-xs-12">
                                    {{Form::text('keywords',null, array('class' => 'form-control','id'=>'keywords','placeholder'=>'文档关键词', 'autocomplete'=>"off",'required'=>'required'))}}
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                {{Form::label('topid', '品牌所属父类', array('class' => 'col-sm-2 control-label'))}}
                                <div class="col-md-4">
                                    {{Form::select('topid', $allnavinfos, null,array('class'=>'form-control select2' ,'id'=>'topid'))}}
                                </div>
                            </div>
                            <div class="form-group col-md-12 ">
                                {{Form::label('typeid', '品牌所属子类', array('class' => 'col-sm-2 control-label'))}}
                                <div class="col-md-4">
                                    {{Form::select('typeid', [], null,array('class'=>'form-control select2'))}}
                                </div>
                            </div>
                            <div class="form-group col-md-12 has-warning">
                                {{Form::label('xiongzhang', '资源提交', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                <div class="radio col-md-4 col-sm-9 col-xs-12">
                                    {{Form::radio('xiongzhang', '1', false,array('class'=>'flat-red'))}} 快速收录
                                    {{Form::radio('xiongzhang', '2', true,array('class'=>'flat-red','id'=>'xiongzhang2'))}} 普通收录
                                    <span class="help-block" ><i class="fa fa-bell-o"></i>  快速收录工具可以向百度搜索主动推送资源，缩短爬虫发现网站链接的时间，对于高实效性内容推荐使用快速收录工具，实时向搜索推送资源。普通收录接口，每天可提交最多500万条有价值内容。提交的内容会进入百度搜索统一管理，请耐心等待。</span>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                {{Form::label('description', '文档描述', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                <div class="col-md-4 col-sm-9 col-xs-12">
                                    {{Form::textarea('description',null, array('class' => 'form-control col-md-10','id'=>'desrciption','rows'=>3,'placeholder'=>'不填写将自动提取首段'))}}
                                </div>
                            </div>
                            <div class="form-group col-md-12 ">
                                {{Form::label('ismake', '文章状态', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                <div class="radio col-md-4 col-sm-9 col-xs-12">
                                    {{Form::radio('ismake', '1', true,array('class'=>'flat-red'))}} 已审核
                                    {{Form::radio('ismake', '0', false,array('class'=>'flat-red','id'=>'ismake2'))}}未审核
                                </div>
                            </div>
                            <div class="form-group col-md-12 ">
                                {{Form::label('published_at', '预选发布时间', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                <div class="input-group date  col-md-4 " style="padding-right: 15px; padding-left: 15px;">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    {{Form::text('published_at', Carbon\Carbon::now(), array('class' => 'form-control pull-right','id'=>'datepicker','placeholder'=>'点击选择时间', 'autocomplete'=>"off"))}}
                                </div>
                            </div>
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
                            {{Form::file('image', array('class' => 'file col-md-10 file-inputs','id'=>'input-2','data-show-upload'=>"false",'data-show-caption'=>"true",'accept'=>'image/*'))}}
                        </div>
                    </div>
                </li>
                <li>
                    <i class="fa fa-photo bg-aqua"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{date('D M j')}}</span>
                        <h3 class="timeline-header no-border"><a href="#">封面推荐缩略图</a> 图片上传</h3>
                        <div class="timeline-body">
                            {{Form::file('indexlitpic', array('class' => 'file col-md-10 file-inputs','id'=>'input-3','data-show-upload'=>"false",'data-show-caption'=>"true",'accept'=>'image/*'))}}
                        </div>
                    </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline item -->
                <li>
                    <i class="fa fa-user bg-yellow"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                        <h3 class="timeline-header"><a href="#">产品信息</a> 产品信息描述</h3>

                        <div class="timeline-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    {{Form::label('brandname', '品牌名称', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                        {{Form::text('brandname',null, array('class' => 'form-control col-md-10','id'=>'brandname','placeholder'=>'品牌名称','required'=>'required', 'autocomplete'=>"off"))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('brandtime', '成立时间', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                        {{Form::text('brandtime', null, array('class' => 'form-control col-md-10','id'=>'brandtime','placeholder'=>'1970-1-1', 'autocomplete'=>"off"))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('province_id', '区域分类/省', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                        {{Form::select('province_id', $provinces, null,array('class'=>'form-control select2'))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('city_id', '区域分类/市', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                        {{Form::select('city_id', [], null,array('class'=>'form-control select2'))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('genre', '公司性质', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                        {{Form::select('genre', ['民营企业'=>'民营企业','个体经营'=>'个体经营','股份制公司'=>'股份制公司','私营企业'], null,array('class'=>'form-control select2'))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6 ">
                                    {{Form::label('acreage', '所需面积', array('class' => 'col-sm-2 control-label'))}}
                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                        {{Form::select('acreage', $acreagements, null,array('class'=>'form-control select2'))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6 ">
                                    {{Form::label('tzid', '店面投资', array('class' => 'col-sm-2 control-label'))}}
                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                        {{Form::select('tzid', $investments, null,array('class'=>'form-control select2'))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('brandpay', '投资金额', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                        {{Form::text('brandpay', null, array('class' => 'form-control col-md-10','id'=>'brandpay','placeholder'=>'请填写实际投资金额区间'))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('brandduty', '是否区域授权', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                        {{Form::select('brandduty', ['否','是'], null,array('class'=>'form-control select2'))}}
                                        {{Form::hidden('mid', '1', array('class' => 'form-control col-md-10','id'=>'mid'))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('brandnum', '门店总数', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                        {{Form::text('brandnum', null, array('class' => 'form-control col-md-10','id'=>'brandnum','placeholder'=>'门店总数', 'autocomplete'=>"off"))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('brandarea', '加盟区域', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                        {{Form::text('brandarea', null, array('class' => 'form-control col-md-10','id'=>'brandarea','placeholder'=>'加盟区域'))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('brandmap', '经营范围', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                        {{Form::text('brandmap', null, array('class' => 'form-control col-md-10','id'=>'brandmap','placeholder'=>'经营范围'))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('brandperson', '加盟人群', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                        {{Form::text('brandperson', null, array('class' => 'form-control col-md-10','id'=>'brandperson','placeholder'=>'加盟人群'))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('brandattch', '加盟意向人数', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                        {{Form::text('brandattch', null, array('class' => 'form-control col-md-10','id'=>'brandattch','placeholder'=>'加盟意向人数', 'autocomplete'=>"off"))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('brandapply', '项目收藏人数', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                        {{Form::text('brandapply', null, array('class' => 'form-control col-md-10','id'=>'brandapply','placeholder'=>'项目收藏人数', 'autocomplete'=>"off"))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('brandchat', '项目咨询人数', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                        {{Form::text('brandchat', null, array('class' => 'form-control col-md-10','id'=>'brandchat','placeholder'=>'项目咨询人数', 'autocomplete'=>"off"))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('brandgroup', '公司名称', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                        {{Form::text('brandgroup', null, array('class' => 'form-control col-md-10','id'=>'brandgroup','placeholder'=>'公司名称', 'autocomplete'=>"off"))}}
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    {{Form::label('brandaddr', '公司地址', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                        {{Form::text('brandaddr', null, array('class' => 'form-control col-md-10','id'=>'brandaddr','placeholder'=>'公司地址','required'=>'required', 'autocomplete'=>"off"))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('registeredcapital', '注册资金', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                        {{Form::text('registeredcapital', null, array('class' => 'form-control col-md-10','id'=>'registeredcapital','placeholder'=>'注册资金', 'autocomplete'=>"off"))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('texuid', '特许备案号', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                        {{Form::text('texuid', null, array('class' => 'form-control col-md-10','id'=>'texuid','placeholder'=>'特许备案号 如无可不填写', 'autocomplete'=>"off"))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('brandphone', '品牌电话', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                        {{Form::text('brandphone', null, array('class' => 'form-control col-md-10','id'=>'brandphone','placeholder'=>'如无特别指明，无需填写', 'autocomplete'=>"off"))}}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    {{Form::label('url', '品牌官网', array('class' => 'control-label col-md-2 col-sm-3 col-xs-12'))}}
                                    <div class="col-md-8 col-sm-9 col-xs-12">
                                        {{Form::text('url', null, array('class' => 'form-control col-md-10','id'=>'url','placeholder'=>'如无特别指明，无需填写', 'autocomplete'=>"off"))}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-footer">
                            <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                        </div>
                    </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline item -->
                <li>
                    <i class="fa fa-camera bg-purple"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{date('j, n,y')}}</span>

                        <h3 class="timeline-header"><a href="#">图集处理</a> 批量上传图集</h3>
                        <div class="timeline-body">
                            {{Form::file('image', array('name'=>'input-image','class' => 'file-loading file-inputs','id'=>'input-image-1','multiple','accept'=>'image/*'))}}
                            <div id="kv-success-modal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Yippee!</h4>
                                        </div>
                                        <div id="kv-success-box" class="modal-body">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{Form::hidden('imagepics', null,array('id'=>'imagepics'))}}
                        </div>
                    </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline item -->

               @include('admin.layouts.brand_summernote')

                <!-- END timeline item -->
                <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>

        </div>
        <!-- /.col -->
        {!! Form::close() !!}
    </div>
    <button onsubmit="return false;" onclick="getLocalData()" class="btn btn-md bg-green">恢复内容</button>
    @if(count($errors) > 0)
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <!-- /.row -->

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
            getsonTypes("/admin/getsontypes",{"reid":$("#topid").select2("val")},"#typeid");
            getsonTypes("/admin/getareas",{"province_id":$("#province_id").select2("val")},"#city_id");
            $("#topid").on("change",function(){getsonTypes("/admin/getsontypes",{"reid":$("#topid").select2("val")},"#typeid")});
            $("#province_id").on("change",function(){getsonTypes("/admin/getareas",{"province_id":$("#province_id").select2("val")},"#city_id")});
            $('#datepicker').datepicker({autoclose: true,  language: 'zh-CN', todayHighlight: true});
            $('.basic_info input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({checkboxClass: 'icheckbox_flat-green', radioClass: 'iradio_flat-green' });
            $("#input-image-1").fileinput({
                uploadUrl: "/admin/upload/images",
                allowedFileExtensions: ["jpg", "png", "gif",'jpeg'],
                maxImageWidth: 1000,
                theme: 'fa',
                language: 'zh',
                minFileCount: 1,
                maxFileCount: 6,
                overwriteInitial: false,
                resizeImage: true,
                initialPreviewAsData: true,
            }).on('fileuploaded', function(e, params) {
                $('#kv-success-box').html('上传成功！');
                $('#kv-success-modal').modal('show');
                $('.kv-file-remove').hide();
                $("#imagepics").val($("#imagepics").val()+params.response.link+',');
            });
            $("#checktitle input").blur(function(){
                if ($("#checktitle input").val().length)
                {
                    $.ajax(
                        {type:"POST",url:"/admin/article/titlecheck",data:{"title":$("#checktitle input").val()},
                            datatype: "html",
                            success:function (response, stutas, xhr) {
                                if (response=='违禁词，不允许发布' || response==$("#checktitle input").val())
                                {
                                    $("#checktitle").addClass('has-error');
                                    $("#checktitle span em").html("品牌为违禁词或标题已存在，禁止发布");
                                    $("#checktitle span").css("display","block");

                                }else {
                                    $("#checktitle").removeClass('has-error').addClass('has-success');
                                    $("#checktitle span").css("display","none");
                                }
                            }
                        });
                }
            });
        });
        $("#formarticle").submit(function () {
            $("#submitbutton").attr('disabled','disabled');
            $("#submitbutton").html('发布中 请稍后');
        });
    </script>
    <script>
        function getLocalData () {
          var arrs=[ue];
          for (i=0;i<arrs.length;i++)
          {
              if(!arrs[i].hasContents())
              {
                  body=arrs[i].execCommand( "getlocaldata" );
                  arrs[i].setContent(body);
              }
          }
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
                    }
                });
        }
    </script>
@stop


<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandarticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brandarticles', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('typeid');
            $table->integer('ismake');
            $table->integer('click');
            $table->string('title');
            $table->string('flags')->nullable();
            $table->string('tags')->nullable();
            $table->integer('mid');//文档类型
            $table->string('keywords')->nullable();
            $table->string('description')->nullable();
            $table->string('write');
            $table->string('litpic')->nullable();
            $table->smallInteger('dutyadmin');
            $table->text('body')->nullable();
            $table->text('pds')->nullable();
            $table->string('brandname')->nullable();//品牌名称
            $table->string('brandtime')->nullable();//成立时间
            $table->string('brandmoshi')->nullable();//品牌发源地
            $table->string('brandorigin')->nullable();//品牌发源地
            $table->string('brandnum')->nullable();//门店总数
            $table->string('brandpay')->nullable();//加盟费用
            $table->string('brandarea')->nullable();//加盟区域
            $table->string('brandmap')->nullable();//经营范围
            $table->string('brandperson')->nullable();//加盟人群
            $table->string('brandattch')->nullable();//加盟意向人数
            $table->string('brandapply')->nullable();//申请加盟人数
            $table->string('brandchat')->nullable();//项目咨询人数
            $table->string('brandgroup')->nullable();//公司名称
            $table->string('brandaddr')->nullable();//公司地址
            $table->string('brandduty')->nullable();//区域授权
            $table->integer('province_id')->nullable()->index();//所属省份
            $table->integer('city_id')->nullable()->index();//所属城市
            $table->integer('area_id')->nullable()->index();//所属区县
            $table->mediumText('imagepics')->nullable();//品牌图集
            $table->string('acreage')->nullable();//所需面积
            $table->string('genre')->nullable();//公司性质
            $table->string('licenseno')->nullable();//特许加盟许可证号
            $table->string('registeredcapital')->nullable();//注册资金
            $table->string('brandpsp')->nullable();//品牌特色
            $table->index('brandname');
            $table->index('brandnum');
            $table->timestamp('published_at')->nullable();//预选发布时间
            $table->timestamps();
            $table->timestamp('origin_time')->nullable()->index();//原始发布时间
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brandarticles');
    }
}

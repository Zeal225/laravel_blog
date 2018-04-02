<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titre',50);
            $table->text('contenu');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
        });
        Schema::create('commentaires', function (Blueprint $table){
            $table->increments('id');
            $table->text('contenu');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->integer('article_id')->unsigned();
        });
        Schema::create('reponses', function (Blueprint $table){
            $table->increments('id');
            $table->text('contenu');
            $table->timestamps();
            $table->integer('commentaire_id')->unsigned();
            $table->integer('user_id')->unsigned();
        });
        Schema::create('tags', function (Blueprint $table){
            $table->increments('id');
            $table->string('tag', 50)->unique();
            $table->string('tag_url', 60)->unique();
            $table->timestamps();
        });
        Schema::create('tag_article', function (Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->integer('tag_id')->unsigned();
            $table->integer('article_id')->unsigned();
        });
        Schema::table('articles', function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
        });
        Schema::table('commentaires', function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('restrict')->onUpdate('restrict');
        });
        Schema::table('reponses', function (Blueprint $table){
            $table->foreign('commentaire_id')->references('id')->on('commentaires')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
        });
        Schema::table('tag_article', function (Blueprint $table){
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table){
            $table->dropForeign('articles_user_id_foreign');
        });
        Schema::table('commentaires', function (Blueprint $table){
            $table->dropForeign('commentaires_user_id_foreign');
            $table->dropForeign('commentaires_article_id_foreign');
        });
        Schema::table('reponses', function (Blueprint $table){
            $table->dropForeign('reponses_commentaire_id_foreign');
            $table->dropForeign('reponses_user_id_foreign');
        });
        Schema::table('tag_article', function (Blueprint $table){
            $table->dropForeign('tag_article_article_id_foreign');
            $table->dropForeign('tag_article_tag_id_foreign');
        });
        Schema::dropIfExists('users');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('commentaires');
        Schema::dropIfExists('reponses');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('tag_article');
    }
}

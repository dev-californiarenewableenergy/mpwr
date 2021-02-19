<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTermColumnFinancerColumnEniumPointsColumnSalesRepCommissionColumnToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->foreignId('financing_id')->nullable()->after('id');
            $table->foreignId('financer_id')->nullable()->after('financing_id');
            $table->foreignId('term_id')->nullable()->after('financer_id');

            $table->bigInteger('enium_points')->after('opened_by_id')->nullable()->default(0);
            $table->bigInteger('sales_rep_comission')->after('opened_by_id')->default(0);

            $table->foreign('financing_id')->references('opened_by_id')->on('financings')->onDelete('cascade');
            $table->foreign('financer_id')->references('opened_by_id')->on('financers')->onDelete('cascade');
            $table->foreign('term_id')->references('opened_by_id')->on('terms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['financing_id', 'financer_id', 'term_id']);

            $table->dropColumn('financing_id');
            $table->dropColumn('financer_id');
            $table->dropColumn('term_id');
            $table->dropColumn('enium_points');
            $table->dropColumn('sales_rep_comission');
        });
    }
}

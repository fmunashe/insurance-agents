<?php

use App\Models\Commission;
use App\Models\Currency;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('insureds', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Supplier::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Currency::class)->constrained()->onDelete('cascade');
            $table->string('policy_number');
            $table->double('sum_insured');
            $table->double('premium');
            $table->double('rate');
            $table->integer('number_of_terms')->default(1);
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('status')->default(true);
            $table->string('policy_schedule_link')->nullable();
            $table->foreignIdFor(Commission::class)->nullable()->constrained()->onDelete('cascade');
            $table->double('commission_amount')->default(0);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insureds');
    }
};

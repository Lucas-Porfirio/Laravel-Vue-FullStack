<?php

use App\Enums\PessoaTipoEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pessoa', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cpf', 14)->unique();
            $table->enum('tipo', PessoaTipoEnum::getValues());
            $table->string('telefone', 15)->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamps();
        });
        DB::statement("ALTER TABLE pessoa 
            ADD CONSTRAINT chk_tipo_pessoa 
            CHECK (
                (tipo = ".PessoaTipoEnum::FISICA->value." AND LENGTH(cpf) = 11) OR 
                (tipo = ".PessoaTipoEnum::JURIDICA->value." AND LENGTH(cpf) = 14)
            )");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pessoa');
    }
};

<?php

namespace App\Jobs\SchoolClass;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\SchoolClass;

class UpdateClass implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $validatedData;
    protected $classId;

    /**
     * Create a new job instance.
     * @param int $classId
     * @param array $validatedData
     */
    public function __construct(int $classId, array $validatedData)
    {
        $this->classId = $classId;
        $this->validatedData = $validatedData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $class = SchoolClass::find($this->classId);

        if ($class) {
            $class->update($this->validatedData);

            info('Turma atualizada com sucesso.', $this->validatedData);
        } else {
            \Log::error('Turma não encontrada para atualização.', ['class_id' => $this->classId]);
        }
    }
}

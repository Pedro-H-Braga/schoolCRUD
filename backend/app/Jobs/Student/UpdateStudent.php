<?php

namespace App\Jobs\Student;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Student;

class UpdateStudent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $validatedData;
    protected $studentId;

    /**
     * Create a new job instance.
     * @param int $studentId
     * @param array $validatedData
     */
    public function __construct(int $studentId, array $validatedData)
    {
        $this->studentId = $studentId;
        $this->validatedData = $validatedData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $student = Student::find($this->studentId);

        if ($student) {
            $student->update($this->validatedData);

            info('Aluno atualizado com sucesso.', $this->validatedData);
        } else {
            \Log::error('Aluno não encontrado atualização.', ['student_id' => $this->studentId]);
        }
    }
}

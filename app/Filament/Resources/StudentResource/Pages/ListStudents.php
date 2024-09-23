<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Exports\StudentExporter;
use App\Filament\Resources\StudentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Imports\StudentImporter;
use Filament\Actions\ImportAction;

class ListStudents extends ListRecords
{
    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-c-user-plus'),
            Actions\ImportAction::make()
                ->importer(StudentImporter::class)
                ->color('accent')
                ->icon('heroicon-c-cloud-arrow-up'),
            Actions\ExportAction::make()
                ->exporter(StudentExporter::class)
                ->color('success')
                ->icon('heroicon-c-arrow-down-circle')
        ];
    }
}

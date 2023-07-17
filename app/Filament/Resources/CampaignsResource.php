<?php

namespace App\Filament\Resources;

use App\Models\Groups;
use Filament\Forms\Components\Select;
use App\Filament\Resources\CampaignsResource\Pages;
use App\Filament\Resources\CampaignsResource\RelationManagers;
use App\Models\Campaign;
use App\Models\Template;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CampaignsResource extends Resource
{
    protected static ?string $model = Campaign::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_scheduled')->required() ,
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpan(2)
                    ->maxLength(255),

                Select::make('template_id')
                    ->options(Template::all()->pluck('first_name', 'id'))
                    ->searchable()
                    ->required(),

                Select::make('group_id')
                                    ->options(Groups::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->required(),
                Forms\Components\DateTimePicker::make('scheduled_at')->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('name')->sortable(),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('subject'),
                Tables\Columns\ToggleColumn::make('is_scheduled')->sortable(),
                Tables\Columns\TextColumn::make('scheduled_at')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
//                Tables\Actions\Action::make('Send now', )
//                    ->danger()
//                    ->modal('sendNow'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCampaigns::route('/'),
            'create' => Pages\CreateCampaigns::route('/create'),
            'edit' => Pages\EditCampaigns::route('/{record}/edit'),
        ];
    }
}

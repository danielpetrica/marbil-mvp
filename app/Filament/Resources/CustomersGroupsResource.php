<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomersGroupsResource\Pages;
use App\Models\Customer;
use App\Models\CustomersGroups;
use App\Models\Groups;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomersGroupsResource extends Resource
{
    protected static ?string $model = CustomersGroups::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('customer_id')
                    ->options(Customer::all()->pluck('first_name', 'id'))
                    ->searchable()
                    ->required(),
                Select::make('group_id')
                    ->options(Groups::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer_id'),
                Tables\Columns\TextColumn::make('group_id'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCustomersGroups::route('/'),
            'create' => Pages\CreateCustomersGroups::route('/create'),
            'edit' => Pages\EditCustomersGroups::route('/{record}/edit'),
        ];
    }
}

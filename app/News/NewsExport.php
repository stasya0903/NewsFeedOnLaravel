<?php


namespace App\News;


use App\News\News;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithMapping;

class NewsExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return new Collection(
            [
                $this->headings(),
                $this->map(News::all())
            ]
        );

    }

    public function headings(): array
    {
        return [
            'id',
            'title',
            'text',
            'category',
            'created_at'
        ];
    }

    public function map($news): array
    {
        $formattedNews = [];
        foreach ($news as $item) {
            $formattedNews[] = [
                $item->id,
                $item->title,
                $item->text,
                $item->category->title,
                $item->created_at
            ];
        }
        return $formattedNews;
    }

}


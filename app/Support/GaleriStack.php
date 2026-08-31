<?php

namespace App\Support;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class GaleriStack
{
    public static function group(Collection $items): Collection
    {
        return $items
            ->groupBy(fn ($item) => self::makeKey($item))
            ->map(function (Collection $group, string $key) {
                $group = $group->values();
                $cover = $group->first();

                return [
                    'key' => $key,
                    'judul' => $cover?->judul,
                    'kategori' => $cover?->kategori,
                    'tanggal' => $cover?->tanggal,
                    'cover' => $cover,
                    'items' => $group,
                    'count' => $group->count(),
                ];
            })
            ->values();
    }

    public static function paginate(Collection $items, int $perPage, ?int $page = null, string $pageName = 'page'): LengthAwarePaginator
    {
        $page = $page ?: Paginator::resolveCurrentPage($pageName);
        $page = max(1, (int) $page);
        $total = $items->count();
        $results = $items->slice(($page - 1) * $perPage, $perPage)->values();

        return new LengthAwarePaginator(
            $results,
            $total,
            $perPage,
            $page,
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ]
        );
    }

    private static function makeKey(object $item): string
    {
        $judul = mb_strtolower(trim((string) ($item->judul ?? '')));
        $kategori = mb_strtolower(trim((string) ($item->kategori ?? '')));
        $tanggal = optional($item->tanggal)->format('Y-m-d') ?? '';

        return implode('|', [$judul, $kategori, $tanggal]);
    }
}

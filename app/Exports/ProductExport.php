<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductExport implements WithTitle, FromCollection, WithHeadings, WithEvents, WithCustomStartCell, Responsable, WithMapping, ShouldAutoSize
{
    use Exportable;
    private $fileName = 'san-pham.xlsx';
    private $writerType = Excel::XLSX;
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function collection() {
        return $this->data;
    }

    public function headings(): array {
        return [
            'Mã sản phẩm',
            'Tên sản phẩm',
            'Loại sản phẩm',
            'Nhà sản xuất',
            'Giá (VND)',
            'Chất liệu',
            'Số lượng ngăn',
            'Khối lượng (kg)',
            'Kích thước (cm)',
            'Tải trọng (kg)',
            'Ngăn laptop (inch)',
            'Mô tả',
            'Màu sắc',
            'Số lượng',
            'Giảm giá (%)',
            'Tình trạng'
        ];
    }

    public function map($data): array {
        return [
            $data->ma_sp,
            $data->chi_tiet_sp->ten_sp,
            $data->chi_tiet_sp->loai_sp->ten,
            $data->chi_tiet_sp->nha_san_xuat->ten,
            $data->chi_tiet_sp->gia,
            $data->chi_tiet_sp->chat_lieu,
            $data->chi_tiet_sp->so_ngan,
            $data->chi_tiet_sp->khoi_luong,
            $data->chi_tiet_sp->kich_thuoc,
            $data->chi_tiet_sp->tai_trong,
            $data->chi_tiet_sp->ngan_lap,
            $data->chi_tiet_sp->mo_ta,
            $data->chi_tiet_sp->mau_sac,
            $data->chi_tiet_sp->so_luong,
            $data->chi_tiet_sp->giam_gia * 100,
            $data->chi_tiet_sp->tinh_trang == 0 ? 'Còn hàng' : 'Hết hàng'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                if (count($this->data) <= 0) {
                    $event->sheet->styleCells(
                        'A2:P4',
                        [
                            'borders' => [
                                'allBorders' => [
                                    'borderStyle' => 'thin',
                                    'color' => ['argb' => '#000'],
                                ],
                            ],
                            'font' => [
                                'name' => 'Arial',
                                'size' => 12
                            ],
                            'alignment' => [
                                'vertical' => 'center',
                                'horizontal' => 'center'
                            ]
                        ]
                    );
                    $event->sheet->mergeCells('A2:P4');
                    $event->sheet->setCellValue('A2', 'Không có dữ liệu');
                }
                $event->sheet->styleCells(
                    'A4:P1',
                    [
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => 'thin',
                                'color' => ['argb' => '#000'],
                            ],
                        ],
                        'font' => [
                            'name' => 'Arial',
                            'size' => 10,
                            'bold' => true
                        ],
                        'alignment' => [
                            'vertical' => 'center',
                            'horizontal' => 'center'
                        ],
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'rotation' => 180,
                            'startColor' => [
                                'argb' => 'D9D9D9D9',
                            ]
                        ],
                    ]
                );
                $event->sheet->styleCells(
                    'A2:P'. (count($this->data) + 1),
                    [
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => 'thin',
                                'color' => ['argb' => '#000'],
                            ],
                        ],
                        'font' => [
                            'name' => 'Arial',
                            'size' => 10
                        ],
                        'alignment' => [
                            'vertical' => 'center',
                            'horizontal' => 'center'
                        ]
                    ]
                );
                $event->sheet->numberFormat('E2:E'. (count($this->data) + 1));
                $event->sheet->wrapText('L');
            },
        ];
    }

    public function startCell(): string {
        return 'A1';
    }

    public function title(): string {
        return 'Sản phẩm';
    }


    
}

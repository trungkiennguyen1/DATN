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

class HoaDonExport implements WithTitle, FromCollection, WithHeadings, WithEvents, WithCustomStartCell, Responsable, WithMapping, ShouldAutoSize
{
    use Exportable;
    private $fileName = 'hoa-don.xlsx';
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
            'Mã hóa đơn',
            'Mã khách hàng',
            'Tổng tiền',
            'Ngày đặt',
            'Địa chỉ nhận hàng',
            'Hình thức thanh toán',
            'Ghi chú',
            'Tình trạng'
        ];
    }

    public function map($data): array {
        return [
            $data->ma_hd,
            $data->khach_hang_id,
            $data->tong_tien,
            $data->ngay_dat,
            $data->dia_chi_nhan,
            $data->hinh_thuc_thanh_toan,
            $data->ghi_chu,
            $data->tinh_trang
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                if (count($this->data) <= 0) {
                    $event->sheet->styleCells(
                        'A2:H4',
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
                    'A1:H1',
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
                    'A2:H'. (count($this->data) + 1),
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

                $event->sheet->styleCells(
                    'A2',
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
                $event->sheet->numberFormat('C2:C'. (count($this->data) + 1));
                // $event->sheet->setCellValue('G2', 'Tong: 1235');
                $event->sheet->wrapText('L');
            },
        ];
    }

    public function startCell(): string {
        return 'A1';
    }

    public function title(): string {
        return 'Hóa đơn';
    }


    
}

<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Book;
use App\Models\Catalog;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use DB;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /**
        //soal no.1
        $data = Member::select('*')
                        ->join('users', 'users.member_id', '=', 'members.id')
                        ->get();

        //soal no.2
        $data1 = Member::select('*')
                        ->leftJoin('users', 'users.member_id', '=', 'members.id')
                        ->where('users.member_id', NULL)
                        ->get();

        //soal no.3
        $data2 = Member::select('members.id', 'members.name')
                        ->leftJoin('transactions', 'members.id', '=', 'transactions.member_id')
                        ->where('transactions.id', NULL)
                        ->get();
        
        //soal no.4
        $data3 = Member::select('members.id', 'members.name', 'members.phone_number')
                        ->join('transactions', 'members.id', '=', 'transactions.member_id')
                        ->get();

        //soal no.5
        $data4 = Member::select('members.id', 'members.name', 'members.phone_number', DB::raw('COUNT(transactions.member_id) as total_transaction'))
                        ->join('transactions', 'members.id', '=', 'transactions.member_id')
                        ->groupBy('members.id','members.name','members.phone_number', 'transactions.member_id')
                        ->having('total_transaction','>',1)
                        ->get();

        //soal no.6
        $data5 = Member::select('members.id', 'members.name', 'members.phone_number','transactions.date_start', 'transactions.date_end')
                        ->join('transactions', 'members.id', '=', 'transactions.member_id')
                        ->get();

        //soal no.7
        $data6 = Member::select('members.id', 'members.name', 'members.phone_number','transactions.date_start', 'transactions.date_end')
                        ->join('transactions', 'members.id', '=', 'transactions.member_id')
                        ->whereMonth('transactions.date_end','6')
                        ->get();

        //soal no.8
        $data7 = Member::select('members.id', 'members.name', 'members.phone_number','transactions.date_start', 'transactions.date_end')
                        ->join('transactions', 'members.id', '=', 'transactions.member_id')
                        ->whereMonth('transactions.date_start','5')
                        ->get();
        
        //soal no.9
        $data8 = Member::select('members.id', 'members.name', 'members.phone_number','transactions.date_start', 'transactions.date_end')
                        ->join('transactions', 'members.id', '=', 'transactions.member_id')
                        ->whereMonth('transactions.date_start','6')
                        ->whereMonth('transactions.date_end','6')
                        ->get();
        
        //soal no.10
        $data9 = Member::select('members.id', 'members.name', 'members.phone_number', 'members.address','transactions.date_start', 'transactions.date_end')
                        ->leftJoin('transactions', 'members.id', '=', 'transactions.member_id')
                        ->where('members.address','LIKE','%Bandung%')
                        ->get();

        //soal no.11
        $data10 = Member::select('members.id', 'members.name','members.gender', 'members.phone_number', 'members.address','transactions.date_start', 'transactions.date_end')
                        ->leftJoin('transactions', 'members.id', '=', 'transactions.member_id')
                        ->where('members.address','LIKE','%Bandung%')
                        ->where('members.gender','=','F')
                        ->get();

        //soal no.12
        $data11 = Member::select('members.id', 'members.name', 'members.phone_number','transactions.date_start', 'transactions.date_end','books.isbn',DB::raw('SUM(detail_transactions.qty) as total_qty'))
                        ->join('transactions', 'members.id', '=', 'transactions.member_id')
                        ->join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                        ->join('books', 'detail_transactions.book_id', '=', 'books.id')
                        ->groupBy('members.id', 'members.name', 'members.phone_number','transactions.date_start', 'transactions.date_end','books.isbn')
                        ->having('total_qty','>',1)
                        ->get();

        //soal no.13
        $data12 = Member::select('members.id', 'members.name', 'members.phone_number','transactions.date_start', 'transactions.date_end','books.isbn',DB::raw('SUM(detail_transactions.qty) as total_qty'),
                        'books.title','books.price', DB::raw('SUM(detail_transactions.qty)*books.price as total_price'))
                        ->join('transactions', 'members.id', '=', 'transactions.member_id')
                        ->join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                        ->join('books', 'detail_transactions.book_id', '=', 'books.id')
                        ->groupBy('members.id', 'members.name', 'members.phone_number','transactions.date_start', 'transactions.date_end','books.isbn','books.title', 'books.price')
                        ->orderBy('members.id', 'desc')
                        ->get();

        //soal no.14
        $data13 = Member::select('members.id', 'members.name', 'members.phone_number','transactions.date_start', 'transactions.date_end','books.isbn',DB::raw('SUM(detail_transactions.qty) as total_qty'),
                        'books.title','publishers.name as name_publisher','authors.name as name_author','catalogs.name as genre')
                        ->join('transactions', 'members.id', '=', 'transactions.member_id')
                        ->join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                        ->join('books', 'detail_transactions.book_id', '=', 'books.id')
                        ->join('publishers','books.publisher_id','=','publishers.id')
                        ->join('authors','books.author_id','=','authors.id')
                        ->join('catalogs','books.catalog_id','=','catalogs.id')
                        ->groupBy('members.id', 'members.name', 'members.phone_number','transactions.date_start', 'transactions.date_end','books.isbn','books.title','publishers.name','authors.name','catalogs.name')
                        ->orderBy('members.id', 'desc')
                        ->get();
        
        //soal no.15
        $data14 = Catalog::select('catalogs.id','catalogs.name','books.title','books.isbn')
                        ->join('books','catalogs.id','books.catalog_id')
                        ->orderBy('catalogs.id', 'desc')
                        ->get();
        
        //soal no.16
        $data15 = Book::select('books.*','publishers.name as name_publisher')
                        ->leftJoin('publishers','books.publisher_id','publishers.id')
                        ->orderBy('books.id', 'asc')
                        ->get();

        //soal no.17
        $data16 = Book::select('books.*','authors.name as name_author')
                        ->join('authors','books.author_id','authors.id')
                        ->where('authors.id','=','4')
                        ->get();
        
        //soal no.18
        $data17 = Book::select('*')
                        ->where('price','>',10000)
                        ->get();

        //soal no.19
        $data18 = Book::select('books.*','publishers.name as name_publisher')
                        ->rightJoin('publishers','books.publisher_id','publishers.id')
                        ->where('publishers.id',1)
                        ->where('qty','>',10)
                        ->orderBy('books.id', 'asc')
                        ->get();

        //soal no.20
        $data19 = Member::select('*')
                        ->whereMonth('created_at', '6')
                        ->get();
        return $data19; */
        return view('home');
    }
}

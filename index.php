<?php

require_once "controllers/Bookcc.php";
require_once "models/Book.php";


$aa = new Bookcc();
$bb = isset($_GET['act']) ? $_GET['act'] : "/";
switch ($bb) {
    case 'danhmuc':
        $aa->danhmuc();
        break;
    case 'list':
        $aa->listbook();
        break;

    case 'edit':
        $aa->editbook();
        break;
    case 'delete':
        $aa->deletebook();
        break;
    case 'register':
        $aa->register();
        break;
    case 'login':
        $aa->login();
        break;
    case 'dangxuat':
        $aa->dangxuat();
        break;
    case 'quenmk':
        $aa->quenmk();
        break;

    case 'binh':
        $aa->binh();
        break;
    case 'addDM':
        $aa->addDM();
        break;
    case 'editDM':
        $aa->editDM();
        break;
    case 'deleteDM':
        $aa->deleteDM();
        break;
    case 'listuser':
        $aa->listuser();
        break;
    case 'shophtml':
        $aa->shophtml();
        break;
    case 'trangchu':
        $aa->trangchu();
        // $aa->bannerShow();
        break;
    case 'productDetail':
        $aa->productDetail();
        break;
    case 'checkout':
        $aa->checkout();
        break;
    case 'addToCart':
        $aa->addToCart();
        break;
    case 'cart':
        $aa->cart();
        break;
    case 'clearCart':
        $aa->clearCart();
        break;
    case 'removeFromCart':
        $aa->removeFromCart();
        break;
    case 'updateCartQuantity':
        $aa->updateCartQuantity();
        break;

    case 'binhluan':
        $aa->binhluan();
        break;
    case 'deleteBinhluan':
        $aa->deleteBinhluan();
        break;

    case 'orders':
        $aa->orders();
        break;
    case 'ordersall':
        $aa->ordersall();
        break;
    case 'quanlyorder':
        $aa->quanlyorder();
        break;
    case 'userpro':
        $aa->userpro();
        break;
    // case 'test':
    //     $aa->bannerShow();
    //     break;
    case 'banner_manager':
        $aa->banner_manager();
    break;
    case 'add_banner':
        $aa->add_banner();
    break;
    case 'deleteBanner':
        $aa->deleteBanner();
    break;
    
        // case 'test':
        //     $aa->bannerShow();
        //     break;
        case 'banner_manager':
            $aa->banner_manager();
        break;
        case 'add_banner':
            $aa->add_banner();
        break;
        // case 'update_banner':
        //     $aa->update_banner();
        // break;

    case 'chitietpro':
        $aa->chitietpro();
        break;
    case 'chitietorder':
        $aa->chitietorder();
        break;
    case 'huyorder':
        $aa->huyorder();
        break;


    default:
        $aa->trangchu();
        break;
}

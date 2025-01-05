<?php 

namespace App\Controllers\Admin;

use App\Models\ProductModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Exception;

class ProductController extends AdminController 
{
    private ProductModel $model;

    public function __construct()
    {
        $this->model = new ProductModel();
    }

    /**
     * This method create product and create link
     */
    public function create()
    {
        $product_data = [
            'title' => '',
            'description' => '',
            'price' => 0.00,
        ];

        $this->model->save($product_data);
        $product_id = $this->model->getInsertID();

        $link_model = new \App\Models\SiteLinksModel();

        $product_link_data = [
            'url' => time(),
            'type' => 'product', 
            'menu_item_id' => null, 
            'product_id' => $product_id,
        ];

        $link_model->save($product_link_data);

        return redirect()->to('admin/products');
    }

    /**
     * Method use to edit product
     * 
     * @param integer $id
     */
    public function edit(int $id)
    {
        $product = $this->model->find($id);

        if (!isset($product)) {
            throw new PageNotFoundException('not found product');
        }

        $data = $this->request->getPost();

        $rules = [
            'price' => 'decimal'
        ];

        if (!$this->validateData($data, $rules)) {
            throw new Exception('validation error');
        }

        $this->model->update($id, $data);

        if ($data['title'] !== '') {
            $link_model = new \App\Models\SiteLinksModel();
            $product_link_data = $link_model->where('product_id', $id)->find()[0];

            $link_model->update($product_link_data['id'], ['url' => generateSlug($data['title'])]);
        }

        return redirect()->to('admin/products/' . $id);
    }

    /**
     * This method delete product and remove link
     * 
     * @param integer $id
     */
    public function delete(int $id)
    {
        $product = $this->model->find($id);

        if (!isset($product)) {
            throw new PageNotFoundException('not found product');
        }

        $link_model = new \App\Models\SiteLinksModel();

        $link_model->where('product_id', $id)->delete();
        $this->model->delete($id);

        return redirect()->to('admin/products');
    }

    /**
     * Method return template products list
     * 
     * @return string
     */
    public function list(): string
    {
        $products_list = $this->model->findAll();

        $data = [
            'products_list' => $products_list,
        ];

        return $this->view->addComponent('Admin/Components/ProductsList', $data)
                          ->render();
    }

    /**
     * Method return template details edit page
     * 
     * @param integer $id
     * @return string
     */
    public function details(int $id)
    {
        $product = $this->model->find($id);

        return $this->view->addComponent('Admin/Components/ProductDetails', $product)
                          ->render();
    }
}
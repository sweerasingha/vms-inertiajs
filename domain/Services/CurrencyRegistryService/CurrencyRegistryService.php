<?php

namespace domain\Services\CurrencyRegistryService;

use App\Models\Currency;

class CurrencyRegistryService
{
    protected $currency;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->currency = new Currency();
    }

    /**
     * All
     * retrieve all the data from Currency model
     *
     * @return void
     */
    public function all()
    {
        return $this->currency->all();
    }

    /**
     * Store
     * store data in database
     *
     * @param  array $data
     * @return void
     */
    public function store(array $data)
    {
        return $this->currency->create($data);
    }

    public function baseCurrencyStore(array $data)
    {
        $base_currency = $this->currency->getBaseCurrency();
        // dd($base_currency);
        if (empty($base_currency)) {
            return $this->currency->create($data);
        } else {
            // $item = $this->get($base_currency[0]->id);
            $base_currency->base_currency_id = $data['base_currency_id'];
            $base_currency->save();
            return $base_currency;
        }
    }

    /**
     * getBaseCurrency
     *
     * @return void
     */
    public function getBaseCurrency()
    {
            return  $this->currency->getBaseCurrency();
        // dd($base_currency);
    }

    /**
     * getDollerRate
     *
     * @return void
     */
    public function getDollerRate()
    {
        $doller =   $this->currency->getDollerRate();
        return $doller ? $doller->rate : 1;
    }

    /**
     * Get
     * retrieve relevant data using currency_id
     *
     * @param  int  $currency_id
     * @return void
     */
    public function get(int $currency_id)
    {
        return $this->currency->find($currency_id);
    }

    /**
     * Update
     * update existing data using currency_id
     *
     * @param  array $data
     * @param  int   $currency_id
     * @return void
     */
    public function update(array $data, int $currency_id)
    {
        $currency = $this->currency->find($currency_id);
        return $currency->update($this->edit($currency, $data));
    }

    /**
     * Edit
     * merge data which retrieved from update function as an array
     *
     * @param  Currency $currency
     * @param  array    $data
     * @return void
     */
    protected function edit(Currency $currency, array $data)
    {
        return array_merge($currency->toArray(), $data);
    }

    /**
     * Delete
     * delete specific data using currency_id
     *
     * @param  int  $currency_id
     * @return void
     */
    public function delete(int $currency_id)
    {
        return $this->currency->find($currency_id)->delete();
    }

    /**
     * ChangeStatus
     * change status of the relevant data row using currency_id
     *
     * @param  int $currency_id
     * @return void
     */
    public function deleteSelected($data)
    {
        $ids = $data->input('ids');
        Currency::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    public function inactive($data)
        {
            $base_currency = Currency::where('code','BC000001')->first();

            foreach($data->ids as $id){
                $currency = Currency::find($id);
                $currency->status = 0;
                $currency->save();

                if($base_currency){
                    if($id==$base_currency->base_currency_id){
                        $b_currency = Currency::find($base_currency->id);
                        $b_currency->base_currency_id = null;
                        $b_currency->save();
                    }
                }

                    // $currency_items = Currency::where('base_currency_id',$id)->get();
                    //     foreach($currency_items as $item){
                    //         if(isset($item->base_currency_id))
                    //         {
                    //             $item->base_currency_id = null;
                    //             $item->update();
                    //         }
                    //     }
            }

            return response()->json([
                'success' => true,
            ]);
        }


    // public function inactive($data)
    // {
    //     // $ids = $data->input('ids');
    //     // // $base_currency = $this->currency->getBaseCurrency();

    //     // $materials = Currency::whereIn('id', $ids)->get();

    //     // foreach ($materials as $material) {
    //     //     $material->status = 0;
    //     //     // if($base_currency==$ids){
    //     //     //     $currency = $this->currency->find($currency_id);
    //     //     //     $currency->base_currency_id = null;
    //     //     // }
    //     //     $material->update();
    //     // }

    //     $id = $data->input('ids');

    //     $currency = Currency::where('id',$id)->first();

    //     $currency->status = 0;
    //     $currency->save();


    //     $currency_items = Currency::all();

    //     foreach($currency_items as $item){
    //         if($item->base_currency_id == $id){
    //             $currency_data = Currency::find($item->id);
    //             $currency_data->base_currency_id = null;
    //             $currency_data->save();

    //         }
    //     }

    //     return response()->json([
    //         'success' => true,
    //     ]);
    // }
    public function active($data)
    {
        $ids = $data->input('ids');

        $materials = Currency::whereIn('id', $ids)->get();

        foreach ($materials as $material) {
            $material->status = 1;
            $material->update();
        }

        return response()->json([
            'success' => true,
        ]);


    }
}

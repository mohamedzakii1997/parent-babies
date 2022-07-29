<?php

namespace App\Http\Controllers;


use App\Actions\AddPartnerAction;
use App\Actions\DeleteBabyAction;
use App\Actions\StoreBabyAction;
use App\Actions\UpdateBabyAction;
use App\Http\Requests\AddPartnerRequest;
use App\Http\Requests\DeleteBabyRequest;
use App\Http\Requests\ShowBabyRequest;
use App\Http\Requests\StoreBabyRequest;
use App\Http\Requests\UpdateBabyRequest;
use App\Http\Resources\BabyResource;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\ParentResource;
use App\Models\Baby;
use App\Models\ParentBaby;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BabyController extends BaseResponse
{
    // list all parent and his partner babies
    public function list(Request $request)
    {
        $babies = Baby::with(['parent'])->whereIn('parent_id',[auth('api')->user()->id,auth('api')->user()->partner_id])
            ->paginate(10)->appends($request->except('page'));
        return $this->response(200, 'My Babies', 200, [], 0, [
            'babies' => BabyResource::collection($babies),
            'pagination' => new PaginationResource($babies)
        ]);
    }

    // store new baby to his babies list
    public function store(StoreBabyRequest $request,StoreBabyAction $storeBabyAction)
    {
        DB::beginTransaction();
        try {
            // action that store baby
            $storeBabyAction->execute($request);
            DB::commit();
            return $this->response(200, 'Baby  Created Successfully', 200);
        } catch (\Exception $exception) {
            DB::rollback();
            return $this->response(500, $exception->getMessage(), 500);
        }

    }

    // show one of his  babies
    public function show(ShowBabyRequest $request)
    {
        $baby = Baby::with(['parent'])->where([['id',$request->babyId]])->first();
        if ($baby) {
            return $this->response(200, 'Baby', 200, [], 0, [
                'baby' => new BabyResource($baby)
            ]);
        }
        return $this->response(101, 'Validation Error', 200, ['Invalid Baby']);
    }



    // update his baby's data
    public function update(UpdateBabyRequest $request,UpdateBabyAction $updateBabyAction)
    {
        DB::beginTransaction();
        try {
            // action that update baby
            $updateBabyAction->execute($request);
            DB::commit();
            return $this->response(200, 'Baby Data Updated Successfully', 200);
        } catch (\Exception $exception) {
            DB::rollback();
            return $this->response(500, $exception->getMessage(), 500);
        }

    }


    // delete one of his babies
    public function destroy(DeleteBabyRequest $request,DeleteBabyAction $deleteBabyAction)
    {
        DB::beginTransaction();
        try {
            // action that delete baby
            $deleteBabyAction->execute($request);
            DB::commit();
            return $this->response(200, 'Baby deleted  Successfully', 200);

        } catch (\Exception $exception) {
            DB::rollback();
            return $this->response(500, $exception->getMessage(), 500);
        }

    }

    // list all parents in system to chose one to be partner
    public function listAllParents(Request $request)
    {

        $parents = ParentBaby::where('id','!=',auth('api')->user()->id)
            ->paginate(10)->appends($request->except('page'));
        return $this->response(200, 'all Parents', 200, [], 0, [
            'parents' => ParentResource::collection($parents),
            'pagination' => new PaginationResource($parents)
        ]);

    }


    // add partner to logged parent so parent now show his babies and partner babies too
    public function addPartner(AddPartnerRequest $request,AddPartnerAction $addPartnerAction)
    {
        DB::beginTransaction();
        try {
            // action that add partner
            $addPartnerAction->execute($request);
            DB::commit();
            return $this->response(200, 'Partner Added  Successfully', 200);

        } catch (\Exception $exception) {
            DB::rollback();
            return $this->response(500, $exception->getMessage(), 500);
        }

    }

    // show his partner data
    public function showPartner()
    {
        $partner = auth('api')->user()->partner;
        if ($partner) {
            return $this->response(200, 'My Partner', 200, [], 0, [
                'partner' => new ParentResource($partner)
            ]);
        }
        return $this->response(200, 'You Have No Partner', 200);

    }

    // remove his partner
    public function removePartner()
    {
        auth('api')->user()->partner_id = null;
        auth('api')->user()->save();
        return $this->response(200, 'You Removed your Partner', 200);

    }
}

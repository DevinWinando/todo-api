<?php

namespace App\Http\Controllers;

use App\Http\Requests\RenameChecklistItemAPIRequest;
use App\Models\Checklist;
use App\Models\ChecklistItem;
use Illuminate\Http\Request;

class ChecklistItemController extends Controller
{
    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/checklists/{id}/item",
     *      summary="OA checklist items",
     *      tags={"Checklist Item"},
     *      description="Get checklist items",
     *      security={{"Bearer":{}}},
     *      @OA\Parameter(
     *         required=true,
     *         name="id",
     *         in="path",
     *         description="Checklist ID",
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request, $id)
    {
        $checklist = Checklist::with('items')->where('id', $id)->first();
        
        if (!$checklist) {
            return response()->json([
                'success' => false,
                'message' => 'Checklist not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Checklist created',
            'data' => $checklist
        ]);
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/checklists/{id}/item/{itemId}",
     *      summary="OA checklist items",
     *      tags={"Checklist Item"},
     *      description="Get checklist items",
     *      security={{"Bearer":{}}},
     *      @OA\Parameter(
     *         required=true,
     *         name="id",
     *         in="path",
     *         description="Checklist ID",
     *      ),
     *      @OA\Parameter(
     *         required=true,
     *         name="itemId",
     *         in="path",
     *         description="Checklist Item ID",
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show(Request $request, $id, $itemId)
    {
        $checklistItem = ChecklistItem::where('id', $itemId)->first();
        
        if (!$checklistItem) {
            return response()->json([
                'success' => false,
                'message' => 'Checklist not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Checklist created',
            'data' => $checklistItem
        ]);
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Post(
     *      path="/checklists/{id}/item",
     *      summary="Show checklists",
     *      tags={"Checklist Item"},
     *      description="Get checklists",
     *      security={{"Bearer":{}}},
     *      @OA\Parameter(
     *         required=true,
     *         name="id",
     *         in="path",
     *         description="Checklist ID",
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              required={"description"},
     *              @OA\Property(
     *                  property="description",
     *                  type="string",
     *                  example="Checklist Item"
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(RenameChecklistItemAPIRequest $request, $id)
    {
        $checklist = ChecklistItem::create($request->all() + ['checklist_id' => $id]);
        
        if (!$checklist) {
            return response()->json([
                'success' => false,
                'message' => 'Checklist not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Checklist created',
            'data' => $checklist
        ]);
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Put(
     *      path="/checklists/{id}/item/{itemId}",
     *      summary="Show checklists",
     *      tags={"Checklist Item"},
     *      description="Get checklists",
     *      security={{"Bearer":{}}},
     *      @OA\Parameter(
     *         required=true,
     *         name="id",
     *         in="path",
     *         description="Checklist ID",
     *      ),
     *      @OA\Parameter(
     *         required=true,
     *         name="itemId",
     *         in="path",
     *         description="Checklist Item ID",
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              required={"description"},
     *              @OA\Property(
     *                  property="description",
     *                  type="string",
     *                  example="Checklist 1"
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function check(Request $request, $id, $itemId)
    {
        $checklistItem = ChecklistItem::where('id', $itemId)->first();

        if (!$checklistItem) {
            return response()->json([
                'success' => false,
                'message' => 'Checklist not found'
            ], 404);
        }

        $checklistItem->update([
            'is_completed' => 1,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Checklist updated',
            'data' => $checklistItem
        ]);
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Put(
     *      path="/checklists/{id}/item/rename/{itemId}",
     *      summary="Show checklists",
     *      tags={"Checklist Item"},
     *      description="Get checklists",
     *      security={{"Bearer":{}}},
     *      @OA\Parameter(
     *         required=true,
     *         name="id",
     *         in="path",
     *         description="Checklist ID",
     *      ),
     *      @OA\Parameter(
     *         required=true,
     *         name="itemId",
     *         in="path",
     *         description="Checklist Item ID",
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              required={"description"},
     *              @OA\Property(
     *                  property="description",
     *                  type="string",
     *                  example="Checklist 1"
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update(RenameChecklistItemAPIRequest $request, $id)
    {
        $checklist = ChecklistItem::where('id', $id)->first();
        
        if (!$checklist) {
            return response()->json([
                'success' => false,
                'message' => 'Checklist not found'
            ], 404);
        }

        $checklist->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Checklist updated',
            'data' => $checklist
        ]);
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/checklists/{id}/item/{itemId}",
     *      summary="Show checklists",
     *      tags={"Checklist Item"},
     *      description="Get checklists",
     *      security={{"Bearer":{}}},
     *      @OA\Parameter(
     *         required=true,
     *         name="id",
     *         in="path",
     *         description="Checklist ID",
     *      ),
     *      @OA\Parameter(
     *         required=true,
     *         name="itemId",
     *         in="path",
     *         description="Checklist Item ID",
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              required={"description"},
     *              @OA\Property(
     *                  property="description",
     *                  type="string",
     *                  example="Checklist 1"
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function delete(Request $request, $id, $itemId)
    {
        $checklist = ChecklistItem::where('id', $itemId)->where('checklist_id', $id)->first();
        
        if (!$checklist) {
            return response()->json([
                'success' => false,
                'message' => 'Checklist not found'
            ], 404);
        }

        $checklist->delete();

        return response()->json([
            'success' => true,
            'message' => 'Checklist updated',
            'data' => $checklist
        ]);
    }
}

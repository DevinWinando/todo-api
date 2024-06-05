<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/checklists",
     *      summary="Display list of checklists",
     *      tags={"Checklist"},
     *      description="Get checklists",

     *      security={{"Bearer":{}}},
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
    public function index(Request $request)
    {
        $checklists = Checklist::all();

        return response()->json([
            'success' => true,
            'message' => 'Checklists',
            'data' => $checklists
        ]);
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Post(
     *      path="/checklists",
     *      summary="Store checklists",
     *      tags={"Checklist"},
     *      description="Store checklists",

     *      security={{"Bearer":{}}},
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              required={"title"},
     *              @OA\Property(
     *                  property="title",
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
    public function store(Request $request)
    {
        $checklist = new Checklist();
        $checklist->title = $request->title;
        $checklist->save();

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
     * @OA\Delete(
     *      path="/checklists/{id}",
     *      summary="Show checklists",
     *      tags={"Checklist"},
     *      description="Get checklists",
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
    public function delete(Request $request, $id)
    {
        $checklist = Checklist::find($id);
        
        if (!$checklist) {
            return response()->json([
                'success' => false,
                'message' => 'Checklist not found'
            ], 404);
        }

        $checklist->delete();

        return response()->json([
            'success' => true,
            'message' => 'Checklist deleted'
        ]);
    }
}

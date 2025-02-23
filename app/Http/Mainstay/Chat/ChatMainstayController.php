<?php
namespace App\Http\Mainstay\Chat;
use App\Models\CoreEngine\LogicModels\Chat\ChatLogic;
use App\Models\CoreEngine\ProjectModels\Chat\Chat;
use App\Models\System\ControllersModel\MainstayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChatMainstayController extends MainstayController
{
    public function callAction($method, $parameters)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'forbidden']);
        }

        return parent::callAction($method, $parameters);
    }

    public function actionChatStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        $request->merge([
            'user_id' => Auth::id(),
        ]);

        return response()->json(
            (new ChatLogic())->store($request->all())
        );
    }

    public function actionGetChat(Request $request)
    {
        return response()->json(
            Chat::find($request->input('id'))
        );
    }

    public function actionGetChatList()
    {
        return response()->json((new ChatLogic())->getList());
    }

    public function actionChatDelete(Request $request)
    {
        if ($request->isMethod('delete')) {
            return response()->json(
                (new ChatLogic())->deleteChat($request->all())
            );
        }
    }
}

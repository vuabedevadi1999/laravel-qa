<answer :answer="{{ $answer }}" inline-template>
    <div class="media post">
        @include('shared._vote',[
            'model' => $answer
        ])
        <div class="media-body">
            <form v-if="editing" @submit.prevent="update">
                <div class="form-group">
                    <textarea required v-model="body" class="form-control"rows="10"></textarea>
                </div>
                <button class="btn btn-primary" :disabled="isInvalid">Update</button>
                <button class="btn btn-outline-secondary" @click="cancel" type="button">Cancle</button>
            </form>
            <div v-else>
                <div v-html='bodyHtml'>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="ml-auto">
                            @can('update',$answer){{--nếu dùng cách 2 đổi update-question bằng update(tên hàm để authorization việc cập nhật)--}}
                                <a @click.prevent="edit" class="btn btn-sm btn-outline-info">Edit</a>
                            @endcan
        
                            @can('delete',$answer){{--nếu dùng cách 2 đổi delete-question bằng delete(tên hàm để authorization việc xóa)--}}
                            <button @click="destroy" class="btn btn-sm btn-outline-danger">Delete</button>
                            <form class="form-delete" action="{{ route('questions.answers.destroy',[$question->id,$answer->id]) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                            </form>  
                            @endcan     
                        </div>  
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4">
                        <user-info :model="{{ $answer }}" label="Answered"><user-info>
                    </div>
                </div>
            </div>
        </div>
    </div>
</answer>
export default {
    modify(user,model){
        //console.log(model);
        return user.id === model.user_id
        //return true;
    },
    accept(user, answer){
        //console.log(user.id);
        //return user.id === answer.question.user_id
        return user.id === answer.question.user_id;
        //return true;
    }
}

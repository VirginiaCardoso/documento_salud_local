yii.confirm = function (message, okCallback, cancelCallback) {
    //krajeeDialog.confirm(message,okCallback,cancelCallback);
    krajeeDialog.confirm(message, function (result) {
        if (result) { // ok button was pressed
          okCallback();
        } else { // confirmation was cancelled

        }
    });
};

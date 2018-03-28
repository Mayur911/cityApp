billpayApp.controller("billpayctrl", function($scope) {
    $scope.billpay = model;

    $scope.dueBills = function() {
        var items = $scope.billpay.items;
        var counter = 0;
        for (var i = 0; i < items.length; i++) {
            if (!items[i].status) {
                counter++;
            }
        }
        return counter;
    }

    $scope.redFlag = function() {
        return $scope.dueBills() <= 2 ? "label-success" : "label-danger";
    }

    $scope.addBills = function(billName) {
        obj = {
            bill: billName,
            status: false
        }
        $scope.billpay.items.push(obj);
    }

    $scope.removeBills = function(rmvBills) {
        $scope.billpay.items.splice($scope.billpay.items.indexOf(rmvBills), 1);
    }
});
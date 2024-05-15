<!DOCTYPE html>
<html>
<body>


<div class="paye">
<h1>Paiement</h1>
<p>Numéro de carte <span id="p1">Expiration</span><span id="p2">CVC</span></p>
<input class="carte1" type="text" name="num-carte"  autocomplete="off"  placeholder="1234 1234 1234 1234" required>
<input class="carte2" type="text" name="exp-carte"  autocomplete="off"  placeholder="MM/YY" required>
<input class="carte3" type="text" name="CVC"  autocomplete="off"  placeholder="CVC" required>
</div>

<style type="text/css">
#p1 {
margin-left:50px;
}
#p2 {
margin-left:40px;
margin-right:70px;

}

.paye {
text-align:center;
}
.carte2 {
width:100px;
}
.carte3 {
width:100px;
}

</style>


</body>
</html>

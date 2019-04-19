
<a style="float:right;margin-right: 4%;margin-top: 1%;" class="btn btn-outline-warning" href="logout">Logout</a>
<a style="float:left;margin-left: 4%;margin-top: 1%;" href="lk">My account</a>

    <div class="tableDiv">
    <table class="table table-bordered table-success">
        <thead class="table-primary">
        <tr>
            <td>Task</td>
            <td>Deadline</td>
            <td>Modify</td>
            <td>Delete</td>
        </tr>
        </thead>

        <?php
        $i = 0;
        foreach ($res as $task) {
//            echo '<pre>';
//        print_r($task);


            $idDb = $res[$i]->id;
//            echo '<pre>';
//            print_r($i);
//            echo '<br>';
//            print_r($idDb);
            $i++;



        //
        //
        //    if (!$task)
        //        continue;
        //


        //
        $customThemeR = '';
        if ($task->deadline <= 24)
            $customThemeR = 'table-danger';

        //    $expireTime = [];
        //$expireTime[$idDb] = time() + $task->deadline * 60 * 60;
        // if ($expireTime[$idDb] > time()) {
        //                    echo '<pre>';
        //                    print_r( /*date('Y.m.j H:i:s',*/
        //                        $expireTime);
        //                    echo '</pre>';

        ?>

        <tbody>
        <tr>
            <td class="<?= $customThemeR ?>"><?= $task->task ?></td>
            <td class="<?= $customThemeR ?>"><?= $task->deadline . ' hours' ?></td>
            <td class="<?= $customThemeR ?>"><a class="btn btn-primary" href="modify?id=<?= $idDb ?>">Modify</a>
            </td>
            <td class="<?= $customThemeR ?>"><a class="btn btn-danger"
                                                href="delete?numberOfRecord=<?= $idDb ?>">Delete</a>
            </td>
            <!--                    <td><a class="btn btn-danger" href="#" id="delBtn" >X</a></td>-->
        </tr>
        </tbody>


        <?
        }
        ?>
    </table>
</div>
<div class="formDivAdd">
    <form action="add" method="post">
        <p>Добавление данных в таблицу</p>
        <input autocomplete="off" placeholder="Enter task" name="task">
        <input autocomplete="off" placeholder="deadline[hours]" type="number" name="deadline">
        <button class="btn btn-outline-dark" type="submit">Send</button>
    </form>
</div>

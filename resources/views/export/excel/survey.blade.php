<table border="1">
    <tr>
        <th>หัวข้อ</th>
        <th>คะแนน 1</th>
        <th>คะแนน 2</th>
        <th>คะแนน 3</th>
        <th>คะแนน 4</th>
        <th>คะแนน 5</th>
        <th>คะแนนเฉลี่ย</th>
    </tr>
    @foreach ($groupedResults as $surveyId => $ratings)
        @php
            $totalResponses = 0;
            $weightedSum = 0;
            for ($i = 1; $i <= 5; $i++) {
                $count = $ratings->firstWhere('rating', $i)->count ?? 0;
                $totalResponses += $count; // รวมจำนวนคนตอบทั้งหมด
                $weightedSum += $i * $count; // คำนวณคะแนนถ่วงน้ำหนัก
            }
            $averageScore = $totalResponses > 0 ? round($weightedSum / $totalResponses, 2) : 0; // คำนวณคะแนนเฉลี่ย
        @endphp
        <tr>
            <td>{{ $surveys->firstWhere('id', $surveyId)->title ?? 'Unknown' }}</td>
            @for ($i = 1; $i <= 5; $i++)
                <td>
                    {{ $ratings->firstWhere('rating', $i)->count ?? 0 }}
                </td>
            @endfor
            <td>{{ $averageScore }}</td> <!-- แสดงคะแนนเฉลี่ย -->
        </tr>
    @endforeach
</table>
